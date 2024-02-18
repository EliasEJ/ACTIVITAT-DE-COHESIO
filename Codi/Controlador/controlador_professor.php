<?php
require_once("../Vista/index_professor.php");
include_once("../Model/model_professor.php");
include_once("../Model/model_activitat.php");
//include_once("controlador.php");
include_once("../Model/model.php");



function obtenerIdProfessor()
{
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
        $profe = obtenirProfessorUnic($idProfe)->fetch();
        $html = "<div class='btn-group'>";
        $html .= "<button type='button' class='btn dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>";
        if (isset($_SESSION['picture'])) {
            $picture = $_SESSION['picture'];
            $html .= "<img src='$picture' alt='Imagen de perfil del usuario' class='imgPerfil'>";
        }

        //$email = $_SESSION['email'];
        $nombre = $profe['user'];
        if ($nombre) {
            $html .= $nombre;
        }
        $html .= "</button>";
        $html .= "<ul class='dropdown-menu'>";
        $html .= "<li><a class='dropdown-item ' href=''>Vista</a></li>";
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

                $taulaBody .= "<td>" . $al['cognom'] . ", " . $al['nom'] . "</td>";
                $taulaBody .= "<td>" . "Grup " . $al['grup_id'] . "</td>";
                $taulaBody .= "<td> <input type='checkbox' id='check " . $al['alumne_id'] . "'> </td>";
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
            $html .= "<button class='btn btn-primary' id='deleteAct'><a style='color:white' href='../Controlador/administrar_activitat.php?accio=delete&idAct=" . $act['actividad_id'] . "  '>Eliminar Activitat</a></button>";
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
        $idProfessor = $idProfe;
        $activitat = obtenirActivitatUnic($idProfessor)->fetch();
        $html = "";
        if ($activitat != null) {
            $html .= "<div class='col'>";
            $html .= "<form action='../Controlador/administrar_activitat.php' method='POST'>";
            $html .= "<h3>La teva activitat</h3><br>";
            $html .= "<label><b>Identificador activitat</b></label><br>";
            $html .= "<label >Activitat </label><input type='number' name='idAct' value='" . $activitat['actividad_id'] . "' readonly></input><br><br>";
            $html .= "<label><b>Nom d'activitat</b></label><br>";
            $html .= "<input name='nomAct' id='nomAct' type='text' value=" . $activitat['nom'] . "><br><br>";
            $html .= "<label><b>Descripció</b></label><br>";
            $html .= "<textarea id='descripcio' name='descripcioAct' cols='40' rows='10'>" . $activitat['descripcio'] . "</textarea><br><br>";
            $html .= "<label><b>Grups principals:</b> Grup" . $activitat['grup1'] . " VS Grup" . $activitat['grup2'] . "</label><br><br>";
            $html .= "<input class='btn btn-primary' type='submit' id='saveActivitat' value='Salvar'></input>";
            $html .= "</form><br>";
            $html .= "<button class='btn btn-primary admAct' id='cancelActivitat'><a href='../Vista/index_professor.php' style='color:white'>Cancelar </a></button><br>";
            $html .= "<button class='btn btn-primary admAct' id='createActivitat'><a href='../Controlador/administrar_activitat.php?accio=crear' style='color:white'>Crear Activitat </a></button>";
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

function mostrarSeleccioGrupsAlumnes($idProfe)
{
    try {
        $idProfessor = $idProfe;
        $grups = obtenirGrupsProfessor($idProfessor)->fetchAll();
        $alumnes = obtenirAlumnat($idProfessor)->fetchAll();
        $html = "";

        foreach ($alumnes as $al) {
            if ($al['asistencia'] == 1) {
                $html .= "<tr>";
                $html .= "<input type='hidden' name='alumne_id[]' value='".$al['alumne_id']."'>";
                $html .= "<td>" . $al['cognom'] . ", " . $al['nom'] . "</td>";
                $html .= "<td>".$al['grup_id']."</td>";
                $html .= "<td><select class='form-select form-select-sm' name='grup[".$al['alumne_id']."]' aria-label='.form-select-sm'>";
                $html .= "<option value='0'>Cap grup</option>";
                foreach ($grups as $gr) {
                    $selected = ($al['grup_id'] == $gr['grup_id']) ? "selected" : "";
                    $html .= "<option value='" . $gr['grup_id'] . "' $selected>" . $gr['nom'] . "</option>";
                }
                $html .= "</select></td>";
                $html .= "</tr>";
            }
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}

function mostrarGrupsProfessor($idProfessor)
{
    try {
        $idProfessor = $idProfessor;
        $grups = obtenirGrupsProfessor($idProfessor)->fetchAll();
        $html = "";

        foreach ($grups as $gr) {
            $html .= "<table class='table table-striped'>";
            $html .= "<tbody>";
            $html .= "<tr>";
            $html .= "<td>";
            $html .= "<label>" . $gr['nom'] . "</label>";
            $html .= "</td>";
            $html .= "<td>";
            $html .= "<button class='btn btn-primary' id='deleteGrup'><a href='../Controlador/administrar_grup.php?accio=eliminar&idGrup=" . $gr['grup_id'] . "  ' style='color:white;'>Eliminar</a></button>";
            $html .= "</td>";

            $html .= "</tr>";
            $html .= "</tbody>";
            $html .= "</table>";
        }
<<<<<<< HEAD
        $html .= "<button class='btn btn-primary'><a href='../Controlador/administrar_grup.php?accio='crear'' style='color:white;'>Crear Grup</a></button>"; 
=======
        $html .= "<button class='btn btn-primary'><a href='../Controlador/administrar_grup.php?accio=crear' style='color:white;'>Crear Grup</a></button>";
>>>>>>> a213cfe9015dff3863429f0958c585c94dddf9e0
        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarGrupsProfessor:" . $e->getMessage();
    }
}
