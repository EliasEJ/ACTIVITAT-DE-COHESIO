<?php
require_once("../Model/model_admin.php");
require_once("../Model/model_activitat.php");
require_once("../Model/model.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["crearActividad"])) {
        $actividades = obtenirActivitats()->fetchAll();
        $actividadId = count($actividades) + 1;
        $nombre = $_POST["tituloActividadNueva"];
        $descripcion = trim($_POST["descripcionActividadNueva"]);
        $posicion_id = $_POST["posicionNuevaActividad"];
        $professor_id = $_POST["professorDisponible"];
        $grup1 = $_POST["grupo1Disponible"];
        $grup2 = $_POST["grupo2Disponible"];
        $material_id = $_POST["materialNuevaActividad"];
        $comprarMaterial = $_POST['comprarMaterial'];

        if ($nombre == "" || $descripcion == "") {
?>
            <script>
                alert("Error: El nom o la descripció de l'activitat no poden estar buits.");
            </script>
        <?php
        } else if ($grup1 == $grup2) {
        ?>
            <script>
                alert("Error: No es pot repetir l'equip a confrontar.");
            </script>
        <?php
        } else {

            crearActividad($actividadId, $nombre, $descripcion, $posicion_id, $professor_id, $grup1, $grup2, $material_id);
            aplicarActividadProfesor($professor_id, $actividadId);
            actualizarComprarMaterial($material_id, $comprarMaterial)

        ?>
            <script>
                alert("Activitat creat correctament.");
            </script>
        <?php
        }
    } else if (isset($_POST["editarActividad"])) {
        $idActividad = $_POST['idActividad'];
        $nameAct = $_POST['tituloActividadEdit'];
        $descriptAct = $_POST['descripcionActividadEdit'];
        $material_id = $_POST['materialEditActividad'];

        actualizarActividad($idActividad, $nameAct, $descriptAct, $material_id);
    } else if (isset($_POST["generarEnfrentamientos"])) {

        // Paso 1: Obtener la lista de grupos y actividades disponibles
        $grupos = obtenirGrups()->fetchAll();
        $actividades = obtenirActivitats()->fetchAll();

        // Paso 2: Generar todos los posibles enfrentamientos entre grupos para cada actividad
        $enfrentamientos = [];
        foreach ($actividades as $actividad) {
            $enfrentamientos[$actividad['actividad_id']] = [];
            foreach ($grupos as $grupo1) {
                foreach ($grupos as $grupo2) {
                    if ($grupo1['grup_id'] != $grupo2['grup_id']) {
                        $enfrentamientos[$actividad['actividad_id']][] = [$grupo1['grup_id'], $grupo2['grup_id']];
                    }
                }
            }
        }

        // Paso 3: Asignar un enfrentamiento diferente para cada actividad
        foreach ($enfrentamientos as $actividad_id => &$enfrentamiento_actividad) {
            shuffle($enfrentamiento_actividad); // Aleatorizar el orden de los enfrentamientos
            $enfrentamientos[$actividad_id] = array_slice($enfrentamiento_actividad, 0, count($grupos)); // Limitar a un enfrentamiento por grupo
        }
        eliminarEnfrentamientos();
        guardarEnfrentamientos($enfrentamientos);
    }
    ?>
    <script>
        location.replace("../Vista/index_admin.php")
    </script>
<?php

}

function mostrarAlumnes()
{
    try {
        $alumnes = obtenirAlumnes()->fetchAll();
        $html = "<div class='container'>";
        $html .= "<div class='row'>";
        foreach ($alumnes as $alumne) {
            $html .= "<tr>";
            $html .= "<td>" . $alumne['cognom'] . ", " . $alumne['nom'] . "</td>";
            $html .= "<td>" . "Grup " . $alumne['grup_id'] . "</td>";
            $html .= "<td> <select class='form-select form-select-sm' name='asist[" . $alumne['alumne_id'] . "]'  aria-label='.form-select-sm' style='width:100px'> ";
            $html .= "<option value='0'>No</option> ";
            if ($alumne['asistencia_confirmada'] == '1') {
                $html .= "<option value='1' selected>Sí</option>;";
            } else $html .= "<option value='1'>Sí</option>;";

            $html .= "<td>" . ($alumne['asistencia'] == 1 ? "Sí" : "No") . "</td>";
            $html .= "</tr>";
        }
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarActivitatAdmin: " . $e->getMessage();
    }
}
function mostrarGrups()
{
    try {
        $grups = obtenimGrups()->fetchAll();
        $html = "<div class='container'>";
        $html .= "<div class='row'>";
        foreach ($grups as $grup) {
            $html .= "<tr>";
            $html .= "<td>" . $grup['grup_id'] . "</td>";
            $html .= "<td>" . $grup['nom'] . "</td>";
            $html .= "<td>" . $grup['tutor'] . "</td>";
            $html .= "<td>" . $grup['curs'] . "</td>";
            $html .= "</tr>";
        }
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarGrupos: " . $e->getMessage();
    }
}

function mostrarActivitatsAdmin()
{
    try {
        $activitats = obtenirActivitats()->fetchAll();
        $html = "";
        foreach ($activitats as $act) {
            $material = obtenerMaterialActividad($act['actividad_id'])->fetch();
            $professor = obtenirProfessorUnic($act['professor_id'])->fetch();
            $html .= "<div class='accordion-item'>";
            $html .= "";
            $html .= "<h2 class='accordion-header' id='accordionActividad" . $act['actividad_id'] . "'>";
            $html .= "<button class='accordion-button collapsed' data-bs-toggle='collapse' data-bs-target='#infoActividad" . $act['actividad_id'] . "' aria-expanded='false'>";
            $html .= "Activitat " . $act['actividad_id'] . " - " . $act['nom'];
            $html .= "</button>";
            $html .= "</h2>";
            $html .= "<div id='infoActividad" . $act['actividad_id'] . "' class='accordion-collapse collapse' aria-labelledby='flush-headingOne' data-bs-parent='#accordionActivitatsPadre'>";
            $html .= "<div class='accordion-body'>";
            $html .= "<h3>" . $act['nom'] . "</h3><br>";
            $html .= "<p><b>Descripció</b></p><p>" . $act['descripcio'] . "</p>";
            $html .= "<p><b>Material: </b>" . $material['nom'] . "</p>";
            $comprar =  $material['comprar'] == 1 ? "Si" : "No";
            $html .= "<p><b>Comprar material? </b> " . $comprar . "</p>";
            $html .= "<p><b>On es jugará?</b> Posició número: " . $act['posicion_id'] . "</p>";
            $html .= "<p><b>Grups principals:</b> Grup" . $act['grup1'] . " VS Grup" . $act['grup2'] . "</p>";
            $html .= "<p><b> Professor encarregat: </b>" . $professor['nom'] . " " . $professor['cognom'] . "</p>";
            $html .= "<button class='btn btn-danger deleteAct'><a style='color:white' href='../Controlador/administrar_activitat.php?accio=deleteAdmin&idAct=" . $act['actividad_id'] . "  '>Eliminar Activitat</a></button>&nbsp;&nbsp";
            $html .= "<button class='btn btn-primary editAct' id='" . $act['actividad_id'] . "' data-id='" . $act['actividad_id'] . "' data-nom='" . $act['nom'] . "' data-descripcio='" . $act['descripcio'] . "' data-posicio_id='" . $act['posicion_id'] . "' data-grup1='" . $act['grup1'] . "' data-grup2='" . $act['grup2'] . "' data-id-professor='" . $act['professor_id'] . "' data-toggle='modal' data-target='#modalEditActividad'>
            Editar Activitat
            </button>
            ";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarActivitats: " . $e->getMessage();
    }
}



function mostrarMaterialDisponible()
{
    try {
        $material = obtenerMaterial()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='materialNuevaActividad' aria-label='.form-select-sm'>";
        foreach ($material as $mat) {
            $html .= "<option value='" . $mat['material_id'] . "'>" . $mat['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarMaterialDisponible: " . $e->getMessage();
    }
}

function materialEdit()
{
    try {
        $material = obtenerMaterial()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='materialEditActividad' aria-label='.form-select-sm'>";
        foreach ($material as $mat) {
            $html .= "<option value='" . $mat['material_id'] . "'>" . $mat['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error materialEdit: " . $e->getMessage();
    }
}

function mostrarProfesoresDisponibles()
{
    try {
        $profDispo = obtenerProfesoresDisponibles()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='professorDisponible' aria-label='.form-select-sm'>";
        foreach ($profDispo as $prof) {
            $html .= "<option value='" . $prof['professor_id'] . "'>" . $prof['cognom'] . ", " . $prof['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarProfesoresDisponibles: " . $e->getMessage();
    }
}
function mostrarTodosProfesores()
{
    try {
        $profDispo = obtenirProfessors()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='professorDisponible' aria-label='.form-select-sm'>";
        foreach ($profDispo as $prof) {
            $html .= "<option value='" . $prof['professor_id'] . "'>" . $prof['cognom'] . ", " . $prof['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarProfesoresDisponibles: " . $e->getMessage();
    }
}

function mostrarGruposDisponibles1()
{
    try {
        $grupos = obtenerGruposDisponibles()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='grupo1Disponible' aria-label='.form-select-sm'>";
        $html .= "<option value='0'>Cap grup</option>";
        foreach ($grupos as $grup) {
            $html .= "<option value='" . $grup['grup_id'] . "'>" . $grup['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarGruposDisponibles1: " . $e->getMessage();
    }
}

function mostrarGruposDisponibles2()
{
    try {
        $grupos = obtenerGruposDisponibles()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='grupo2Disponible' aria-label='.form-select-sm'>";
        $html .= "<option value='0'>Cap grup</option>";
        foreach ($grupos as $grup) {
            $html .= "<option value='" . $grup['grup_id'] . "'>" . $grup['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarGruposDisponibles2: " . $e->getMessage();
    }
}

function mostrarPosiciones()
{
    try {
        $posiciones = obtenerPosiciones()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='posicionNuevaActividad' aria-label='.form-select-sm'>";
        foreach ($posiciones as $pos) {
            $html .= "<option value='" . $pos['posicion_id'] . "'>" . $pos['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarPosiciones: " . $e->getMessage();
    }
}

function mostrarEditPosiciones()
{
    try {
        $posiciones = obtenerPosiciones()->fetchAll();
        $html = "";
        $html .= "<select class='form-select form-select-sm' name='posicionEditActividad' aria-label='.form-select-sm'>";
        foreach ($posiciones as $pos) {
            $html .= "<option value='" . $pos['posicion_id'] . "'>" . $pos['nom'] . "</option>";
        }
        $html .= "</select>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarPosiciones: " . $e->getMessage();
    }
}


function crearGrupsAutomaticament()
{
    $alumnes = obtenirAlumnes()->fetchAll(PDO::FETCH_ASSOC);

    //Ordenem els alumnes per curs, classe i any, si no es fes aixo es crearian molts mes grups dels necesaris
    usort($alumnes, function ($a, $b) {
        if ($a['curs'] . $a['classe'] . $a['any'] == $b['curs'] . $b['classe'] . $b['any']) {
            return 0;
        }
        return ($a['curs'] . $a['classe'] . $a['any'] > $b['curs'] . $b['classe'] . $b['any']) ? 1 : -1;
    });

    // Eliminem tots els grups existents
    eliminarGrups();
    $grupo = [];
    $cursoActual = '';
    $claseActual = '';
    $anyActual = '';
    $contador = 0;
    foreach ($alumnes as $alumno) {
        // Si el curso o la clase cambia, o el grupo tiene 20 alumnos, guarda el grupo y crea uno nuevo
        if ($alumno['curs'] != $cursoActual || $alumno['classe'] != $claseActual || $alumno['any'] != $anyActual) {
            $contador = 0;
            if (!empty($grupo)) {
                guardarGrupo($grupo);
            }
            $alumoId = $alumno['alumne_id'];
            $cursoActual = $alumno['curs'];
            $claseActual = $alumno['classe'];
            $anyActual = $alumno['any'];
        }
        $contador++;
        // Añade el alumno al grupo
        $grupo[] = $alumno;
    }

    // Guarda el último grupo si no está vacío
    if (!empty($grupo)) {
        guardarGrupo($grupo);
    }
    assignarGrups($grupo);
    //Com es una accio que nomes pot fer l'administrador li farem una redireccio a la url de l'index de l'administrador
?>
    <!-- <script>
            location.replace("../Vista/index_admin.php")
        </script> -->
        <?php
    }
    function mostrarGrupsAdmin(){
        try {
            $html = "";
    
            $grups = obtenimGrups()->fetchAll();
    
            $html .= "<div class='col'><h3>Grups</h3><br>";
            foreach ($grups as $gr) {
                $html .= "<table class='table table-striped'";
                $html .= "<tbody>";
                $html .= "<tr>";
                $html .= "<td>";
                $html .= "<label>" . $gr['nom'] . "</label>";
                $html .= "</td>";
                $html .= "<td>";
                $html .= "<button class='btn btn-danger deleteGrup'><a href='../Controlador/administrar_grup.php?accio=eliminar&idGrup=" . $gr['grup_id'] . "  ' style='color:white;'>Eliminar</a></button>";
                $html .= "</td>";
                $html .= "</tr>";
                $html .= "</tbody>";
                $html .= "</table>";
            }
            $html .= "<button class='btn btn-primary'><a href='../Controlador/administrar_grup.php?accio=crear' style='color:white;'>Crear Grup</a></button>";
            $html .= "<button type='submit' name='generarGrups' class='btn btn-primary'><a href='?generarGrups=true' class='btn btn-primary'>Generar Grups</a></button>";
            $html .= "</div>";
            return $html;
        } catch (PDOException $e) {
            echo "Error mostrarGrupsProfessor:" . $e->getMessage();
        }
    }

function seleccioAlumnesAdmin()
{
    try {
        $html = "";

        $grups = obtenimGrups()->fetchAll();
        $alumnes = obtenerAlumnosTotal()->fetchAll();

        $html .= "<div class='col'><h3>Alumnes</h3><br>";
        $html .= "<form action='../Controlador/administrar_grup.php' method='POST'><table class='table table-striped' id='myTable2'><thead class='sticky-top bg-white'><tr><th>Alumne</th><th>Grup</th><th>Canviar grup</th></tr></thead><tbody>";
        foreach ($alumnes as $al) {
            if ($al['asistencia'] == 1) {

                $html .= "<tr>";
                $html .= "<input type='hidden' name='alumne_id[]' value='" . $al['alumne_id'] . "'>";
                $html .= "<td>" . $al['cognom'] . ", " . $al['nom'] . "</td>";
                $html .= "<td>" . $al['grup_id'] . "</td>";
                $html .= "<td><select class='form-select form-select-sm' name='grup[" . $al['alumne_id'] . "]' aria-label='.form-select-sm'>";
                $html .= "<option value='0'>Cap grup</option>";
                foreach ($grups as $gr) {
                    $selected = ($al['grup_id'] == $gr['grup_id']) ? "selected" : "";
                    $html .= "<option value='" . $gr['grup_id'] . "' $selected>" . $gr['nom'] . "</option>";
                }
                $html .= "</select></td>";
                $html .= "</tr>";
            }
        }
        $html .= "</tbody>";
        $html .= "</table><input type='submit' class='btn btn-success' value='Salvar'></form>";
        $html .= "</div>";
        return $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}
function mostrarGruposAdministrador()
{
    $html = "";
    $html .= mostrarGrupsAdmin();
    $html .= seleccioAlumnesAdmin();

    echo $html;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'comencarJoc') {
    comencarJoc();
    ?>
    <script>
        location.replace("../Vista/index_admin.php")
    </script>
    <?php
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'acabarJoc') {
    acabarJoc();
    ?>
    <script>
        location.replace("../Vista/index_admin.php")
    </script>
    <?php
}

function puntuar($idprofessor){
    try {
        $html = "";
        $html .= "<div class='col'><h3>Puntuar</h3><br>";
        $html .= "<form action='../Controlador/administrar_grup.php' method='POST'><table class='table table-striped' id='myTable2'><thead class='sticky-top bg-white'><tr><th>Alumne</th><th>Grup</th><th>Punts</th></tr></thead><tbody>";
        $alumnes = obtenirAlumnes()->fetchAll();
        foreach ($alumnes as $al) {
            $html .= "<tr>";
            $html .= "<input type='hidden' name='alumne_id[]' value='" . $al['alumne_id'] . "'>";
            $html .= "<td>" . $al['cognom'] . ", " . $al['nom'] . "</td>";
            $html .= "<td>" . $al['grup_id'] . "</td>";
            $html .= "<td><input type='number' name='punts[" . $al['alumne_id'] . "]' value='0'></td>";
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $html .= "</table><input type='submit' class='btn btn-success' value='Salvar'></form>";
        $html .= "</div>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}
?>