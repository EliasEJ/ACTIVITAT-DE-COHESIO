<?php
require_once("../Model/model_professor.php");
include_once("../Model/model_activitat.php");
include_once("../Model/model.php");



function obtenerIdProfessor()
{
    require_once("../Model/model_professor.php");
    session_start();
    if (!isset($_SESSION['email'])) {
        require_once "../../Recursos/autentificacion.php";
        $_SESSION['email'] = $email;
    }
    $email = $_SESSION['email'];
    $profe = obtenirProfessorUnicEmail($email)->fetch();   
    $idProfe = $profe['professor_id'];
    $_SESSION['idProfe'] = $idProfe;
    return $idProfe;
}

function mostrarUsuari($idProfe)
{
    try {
        require_once("../Model/model.php");
        $profe = obtenirProfessorUnic($idProfe)->fetch();
        $html = "<div class='btn-group'>";
        $html .= "<button type='button' class='btn dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>";
        if (isset($_SESSION['picture'])) {
            $picture = $_SESSION['picture'];
            $html .= "<img src='$picture' alt='Imagen de perfil del usuario' class='imgPerfil'>";
        }

        $email = $_SESSION['email'];
        $nombre = $profe['user'];
        if ($nombre) {
            $html .= $nombre;
        }
        $html .= "</button>";
        $html .= "<ul class='dropdown-menu'>";
        $html .= "<li><a class='dropdown-item ' href='../Vista/index_alumne.php'>Vista Alumne</a></li>";
        if(isAdmin($email)){
            $html .= "<li><a class='dropdown-item ' href='../Vista/index_admin.php'>Vista Admin</a></li>";
        }
        $html .= "<li><a class='dropdown-item ' href='../Controlador/logout.php'>Tancar sessió</a></li>";
        $html .= "</ul>";
        $html .= "</div>";
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarUsuari: " . $e->getMessage();
    }
}

function mostrarAlumnat($idProfe)
{
    try {
        $idProfessor = $idProfe;
        $alumnes = obtenirAlumnat($idProfessor)->fetchAll();
        //Why I can't reach the function obtenirAlumnat() from model.php? could you fix it
        if ($alumnes != null) {
            $taulaBody = "";
            foreach ($alumnes as $al) {
                $taulaBody .= "<tr>";
                $taulaBody .= "<input type='hidden' name='asistAl_id[]' value='" . $al['alumne_id'] . "'>";
                $taulaBody .= "<td>" . $al['cognom'] . ", " . $al['nom'] . "</td>";
                $taulaBody .= "<td>" . "Grup " . $al['grup_id'] . "</td>";
                $taulaBody .= "<td> <select class='form-select form-select-sm' name='asist[" . $al['alumne_id'] . "]'  aria-label='.form-select-sm' style='width:100px'> ";
                $taulaBody .= "<option value='0'>No</option> ";
                if($al['asistencia_confirmada'] == '1'){
                    $taulaBody .= "<option value='1' selected>Sí</option>;";
                }else $taulaBody .= "<option value='1'>Sí</option>;";

                $taulaBody .= "</select></td>";
                $taulaBody .= "<td>" . ($al['asistencia'] == 1 ? "Sí" : "No") . "</td>";
                $taulaBody .= "</tr>";
            }

            echo $taulaBody;
        }
    } catch (PDOException $e) {
        echo "Error mostrarAlumnat: " . $e->getMessage();
    }
}

function mostrarActivitats()
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
            $html .= "<p><b>Comprar material? </b> ". $comprar ."</p>";
            $html .= "<p><b>On es jugará?</b> Posició número: " . $act['posicion_id'] . "</p>";
            $html .= "<p><b>Grups principals:</b> Grup" . $act['grup1'] . " VS Grup" . $act['grup2'] . "</p>";
            $html .= "<p><b> Professor encarregat: </b>" . $professor['nom'] . " " . $professor['cognom'] . "</p>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarActivitats: " . $e->getMessage();
    }
}

function mostrarAdministrarActivitat($idProfe)
{

    try {
        require_once("../Model/model_activitat.php");
        $idProfessor = $idProfe;
        $activitat = obtenirActivitatUnic($idProfessor)->fetch();
        $material = obtenerMaterial()->fetchAll();
        $materialUnic = obtenerMaterialUnico($activitat['material_id'])->fetch();
        $html = "";
        if ($activitat != null) {
            $html .= "<div class='col'>";
            $html .= "<form action='../Controlador/administrar_activitat.php' method='POST'>";
            $html .= "<h3>La teva activitat</h3><br>";
            $html .= "<label><b>Identificador activitat</b></label><br>";
            $html .= "<label >Activitat </label><input type='number' name='idAct' value='" . $activitat['actividad_id'] . "' readonly></input><br>";
            $html .= "<label><b>Nom d'activitat</b></label><br>";
            $html .= "<input name='nomAct' id='nomAct' type='text' value=" . $activitat['nom'] . "><br>";
            $html .= "<label><b>Descripció</b></label><br>";
            $html .= "<textarea id='descripcio' name='descripcioAct' cols='40' rows='10'>" . $activitat['descripcio'] . "</textarea><br>";
            $html .= "<label><b>Grups principals:</b> Grup" . $activitat['grup1'] . " VS Grup" . $activitat['grup2'] . "</label><br>";
            $html .= "<label for='selectMaterial'><b>Seleccionar Material</b></label>";
            $html .= "<select class='form-select form-select-sm' name='materialActProf' aria-label='.form-select-sm'>";
            foreach ($material as $mat) {
                $selected = ($activitat['material_id'] == $mat['material_id']) ? "selected" : "";
                $html .= "<option value='".$mat['material_id'] ."' $selected >".$mat['nom']."</option>";
            }
            $html .= "</select><br>";
            $html .= "<label for='comprarMaterial'><b> Comprar material?</b></label>";
            $html .= "<select class='form-select form-select-sm' name='comprarMaterial' aria-label='.form-select-sm' id='comprarMaterial'>";
            $html .= "<option value='0'>No</option>";
            if($materialUnic['comprar'] == 1){
                $html .= "<option value='1' selected>Si</option>";
            }else $html .= "<option value='1'>Si</option>";

            $html .= "</select><br>";
            $html .= "<input class='btn btn-success' type='submit' id='saveActivitat' value='Salvar'></input>";
            $html .= "</form><br>";
            $html .= "<button class='btn btn-danger admAct' id='cancelActivitat'><a href='../Vista/index_professor.php' style='color:white'>Cancelar </a></button><br>";
            $html .= "</div>";
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}

function mostrarClassificació()
{
    try {
        $grups = obtenirGrupsClasificacio()->fetchAll();
        $html = "";
        $posicion = 1;
        foreach ($grups as $gr) {

            $html .= "<tr>";
            $html .= "<td>" . $posicion . "</td>";
            $html .= "<td>" . $gr['nom'] . "</td>";
            $html .= "<td>" . $gr['puntuacio'] . "</td>";
            $html .= "<td>" . $gr['any'] . "-" . $gr['curs'] . " " . $gr['classe'] . "</td>";
            $html .= "</tr>";
            $posicion++;
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}

function mostrarGrupsProfessor($idProf)
{

    try {

        $idProfessor = $idProf;
        $html = "";

        $grups = obtenirGrupsProfessor($idProfessor)->fetchAll();

        $html .= "<div class='col'><h3>Grups</h3><br>";
        foreach ($grups as $gr) {
            $html .= "<table class='table table-striped'>";
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
        $html .= "</div>";
        return $html;
    } catch (PDOException $e) {
        echo "Error mostrarGrupsProfessor:" . $e->getMessage();
    }
}

function mostrarSeleccioGrupsAlumnes($idProfe)
{
    try {
        $idProfessor = $idProfe;

        $html = "";

        $grups = obtenirGrupsProfessor($idProfessor)->fetchAll();
        $alumnes = obtenirAlumnat($idProfessor)->fetchAll();

        $html .= "<div class='col'><h3>Alumnes</h3><br>";
        $html .= "<form action='../Controlador/administrar_grup.php' method='POST'><table class='table table-striped'><thead class='sticky-top bg-white'><tr><th>Alumne</th><th>Grup</th><th>Canviar grup</th></tr></thead><tbody>";
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

function mostrarTodosGrupos()
{
    try {

        $html = "";
        $grupos = obtenirGrupsClasse();

        $html .= "<div class='col'><h3>Grups</h3><br><table class='table table-striped'>";
        $html .= "<thead class='sticky-top bg-white'><tr><th>Identificador</th><th>Nom grup</th><th>Classe</th></tr></thead>";
        $html .= "<tbody>";
        foreach ($grupos as $gr) {
            $html .= "<tr>";
            $html .= "<td>" . $gr['grup_id'] . "</td>";
            $html .= "<td>" . $gr['nom'] . "</td>";
            $html .= "<td>" . $gr['any'] . "-" . $gr['curs'] . " " . $gr['classe'] .  "</td>";
            $html .= "</tr>";
        }

        $html .= "</tbody>";
        $html .= "</table></div>";

        return $html;
    } catch (PDOException $e) {
        echo "Error mostrarTodosGrupos: " . $e->getMessage();
    }
}

function mostrarGruposTutorProfe($idProfessor)
{

    $profe = obtenirProfessorUnic($idProfessor)->fetch();
    $html = "";
    if ($profe['tutor'] == 1) {
        $html .= mostrarGrupsProfessor($idProfessor);
        $html .= mostrarSeleccioGrupsAlumnes($idProfessor);
    } else if ($profe['tutor'] == 0) {
        $html .= mostrarTodosGrupos();
    }

    echo $html;
}

function seleccionGruposNuevoAlumno($idProfe){
    $html = "";
    $grups = obtenirGrupsProfessor($idProfe)->fetchAll();

    $html .= "<select id='newAlumnGrupo' class='form-select form-select-sm' aria-label='.form-select-sm' name='grup'>";
    foreach ($grups as $gr) {
        $html .= "<option value='" . $gr['grup_id'] . "'>" . $gr['nom'] . "</option>";
    }

    $html .= "</select>";
    echo $html;
}

function generaraPosMap() {
    $posMap = obtenirPosMapA();
    if ($posMap instanceof PDOStatement) {
        $resultado = $posMap->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function mostrarPosMap($posMap) {
    if ($posMap) {
        $html = "<table class='table table-striped border'>";
        $html .= "<tr><th>Posició</th><th>Nom</th></tr>";
        foreach ($posMap as $pos) {
            $html .= "<tr><td>" . $pos['posicion_id'] . "</td><td>" . $pos['nom'] . "</td></tr>";
        }
        $html .= "</table>";
        echo $html;
    } else {
        echo "<p style='color:red;'>No se pudo obtener la posición del grupo.</p>";
    }
}