<?php
require_once("../Model/model_admin.php");
function mostrarUsuariAdmin($idProfe){
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

function mostrarAlumnes(){
    try{
        $alumnes = obtenirAlumnes()->fetchAll();
        $html = "<div class='container'>";
        $html .= "<div class='row'>";
        foreach ($alumnes as $alumne){
            $html .= "<tr>";
            $html .= "<td>" . $alumne['cognom'] . ", " . $alumne['nom'] . "</td>";
            $html .= "<td>" . "Grup " . $alumne['grup_id'] . "</td>";
            $html .= "<td> <input type='checkbox' name='asistAlumn[]' value='check-" . $alumne['alumne_id'] . "' id='check-" . $alumne['alumne_id'] . "'> </td>";
            $html .= "<td>" . ($alumne['asistencia'] == 1 ? "Sí" : "No") . "</td>";
            $html .= "</tr>";
        }
        $html .= "</div>";
        $html .= "</div>";
        echo $html;
    }catch(PDOException $e){
        echo "Error mostrarActivitatAdmin: " . $e->getMessage();
    }
}
function mostrarGrups(){
    try{
        $grups = obtenimGrups()->fetchAll();
        $html = "";

        foreach ($grups as $grup) {

            $html .= "<div class='accordion-item'>";
            $html .= "";
            $html .= "<h2 class='accordion-header' id='accordionActividad" . $grup['actividad_id'] . "'>";
            $html .= "<button class='accordion-button collapsed' data-bs-toggle='collapse' data-bs-target='#infoActividad" . $grup['actividad_id'] . "' aria-expanded='false'>";
            $html .= "Activitat "  . $grup['nom'];
            $html .= "</button>";
            $html .= "</h2>";
            $html .= "<div id='infoActividad" . $grup['actividad_id'] . "' class='accordion-collapse collapse' aria-labelledby='flush-headingOne' data-bs-parent='#accordionActivitatsPadre'>";
            $html .= "<div class='accordion-body'>";
            $html .= "<h3>" . $grup['nom'] . "</h3><br>";
            $html .= "<p><b>Descripció</b></p><p>" . $grup['descripcio'] . "</p>";
            $html .= "<p><b>Material: </b>" . $material['nom'] . "</p>";
            $comprar =  $material['comprar'] == 1 ? "Si" : "No";
            $html .= "<p><b>Comprar material? </b> ". $comprar ."</p>";
            $html .= "<p><b>On es jugará?</b> Posició número: " . $grup['posicion_id'] . "</p>";
            $html .= "<p><b>Grups principals:</b> Grup" . $grup['grup1'] . " VS Grup" . $grup['grup2'] . "</p>";
            $html .= "<p><b> Professor encarregat: </b>" . $professor['nom'] . " " . $professor['cognom'] . "</p>";
            $html .= "<button class='btn btn-danger deleteAct' ><a style='color:white' href='../Controlador/administrar_activitat.php?accio=delete&idAct=" . $grup['actividad_id'] . "  '>Eliminar Activitat</a></button>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
    }catch(PDOException $e){
        echo "Error mostrarGrupos: " . $e->getMessage();
    }
}
?>