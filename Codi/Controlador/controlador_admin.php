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
        $grup1 = 8;
        $grup2 = 1;
        $material_id = $_POST["materialNuevaActividad"];
        $comprarMaterial = $_POST['comprarMaterial'];

        crearActividad($actividadId, $nombre, $descripcion, $posicion_id, $professor_id, $grup1, $grup2, $material_id);
        aplicarActividadProfesor($professor_id, $actividadId);
        actualizarComprarMaterial($material_id, $comprarMaterial)

?>
        <script>
            alert("Activitat creat correctament.");
        </script>
    <?php

    } else {



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

        guardarEnfrentamientos($enfrentamientos);
    }
    ?>
    <script>
        location.replace("../Vista/index_admin.php")
    </script>
<?php

}

function mostrarUsuariAdmin($idProfe)
{
    try {
        $profe = obtenirProfessorUnic($idProfe)->fetch();
        $html = "<div class='btn-group'>";
        $html .= "<button type='button' class='btn dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>";
        if (isset($_SESSION['picture'])) {
            $picture = $_SESSION['picture'];
            $html .= "<img src='$picture' alt='Imagen de perfil del usuario' class='imgPerfil'>";
        }
        $nombre = $profe['user'];
        if ($nombre) {
            $html .= $nombre;
        }
        $html .= "</button>";
        $html .= "<ul class='dropdown-menu'>";
        $html .= "<li><a class='dropdown-item ' href='../Vista/index_alumne.php'>Vista Alumne</a></li>";
        $html .= "<li><a class='dropdown-item ' href='../Vista/index_professor.php'>Vista Professor</a></li>";
        $html .= "<li><a class='dropdown-item ' href='../Controlador/logout.php'>Tancar sessió</a></li>";
        $html .= "</ul>";
        $html .= "</div>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarUsuari: " . $e->getMessage();
    }
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
        $grups = mostrarGrupos()->fetchAll();
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
            $html .= "<p><b>On es jugará?</b> Posició número: " . $act['posicion_id'] . "</p>";
            $html .= "<p><b>Grups principals:</b> Grup" . $act['grup1'] . " VS Grup" . $act['grup2'] . "</p>";
            $html .= "<p><b> Professor encarregat: </b>" . $professor['nom'] . " " . $professor['cognom'] . "</p>";
            $html .= "<button class='btn btn-primary deleteAct' ><a style='color:white' href='../Controlador/administrar_activitat.php?accio=deleteAdmin&idAct=" . $act['actividad_id'] . "  '>Eliminar Activitat</a></button>";
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
        echo "Error mostrarProfesoresDisponibles: " . $e->getMessage();
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
        if ($alumno['curs'] != $cursoActual || $alumno['classe'] != $claseActual || $alumno['any'] != $anyActual || $contador > 19) {
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
?>