<?php
require_once("../Model/model_admin.php");
require_once("../Model/model.php");

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
            $html .= "<td> <input type='checkbox' name='asistAlumn[]' value='check-" . $alumne['alumne_id'] . "' id='check-" . $alumne['alumne_id'] . "'> </td>";
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
?>
    <script>
        location.replace("../Vista/index_admin.php")
    </script>
<?php

}
