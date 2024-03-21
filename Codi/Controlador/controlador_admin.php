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
        $grups = mostrarGrupos()->fetchAll();
        $html = "<div class='container'>";
        $html .= "<div class='row'>";
        foreach ($grups as $grup){
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
    }catch(PDOException $e){
        echo "Error mostrarGrupos: " . $e->getMessage();
    }
}


?>