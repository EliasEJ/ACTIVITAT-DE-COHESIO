<?php
require_once("../Vista/index_professor.php");
include_once("../Model/model_professor.php");

function mostrarAlumnat()
{
    try {
        $idProfessor = 1;
        $alumnes = obtenirAlumnat($idProfessor)->fetchAll();

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
            $html .= "<p><b>On es jugará?</b> Posció número: " . $act['posicion_id'] . "</p>";
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

function mostrarAdministrarActivitat()
{

    try {
        $idProfessor = 2;
        $activitat = obtenirActivitatUnic($idProfessor)->fetch();
        $html = "";
        if ($activitat != null) {
            $html .= "<div class='col'>";
            $html .= "<form action=''>";
            $html .= "<h3>La teva activitat</h3>";
            $html .= "<label><b>Nom d'activitat</b></label><br>";
            $html .= "<input name='nomAct' id='nomAct' type='text' value=" . $activitat['nom'] . "><br><br>";
            $html .= "<label><b>Descripció</b></label><br>";
            $html .= "<textarea id='descripcio' name='descripcioAct' cols='40' rows='10'>" . $activitat['descripcio'] . "</textarea><br><br>";
            $html .= "<label><b>Grups principals:</b> Grup" . $activitat['grup1'] . " VS Grup" . $activitat['grup2'] . "</label><br><br>";
            $html .= "<input type='submit' id='saveActivitat' value='Salvar' class='btn btn-primary'></input>";
            $html .= "<form><input type='submit' id='cancelActivitat' value='Cancelar' class='btn btn-primary'></input><form>";
            $html .= "</form>";
            $html .= "</div>";
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}

function mostrarGrups(){
    try {
        $idProfessor = 2;
        $grups = obtenirGrups()->fetchAll();
        $html = "";
        $posicion = 1;
        foreach($grups as $gr){
            
            $html .= "<tr>";
            $html .= "<td>". $posicion . "</td>";
            $html .= "<td>". $gr['nom'] . "</td>";
            $html .= "<td>". $gr['puntuacio'] . "</td>";
            $html .= "<td>". $gr['any'] . "-". $gr['curs'] . " ". $gr['classe'] . "</td>";
            $html .= "</tr>";
            $posicion++;
        }

        echo $html;
    } catch (PDOException $e) {
        echo "Error mostrarAdministrarActivitat: " . $e->getMessage();
    }
}

?>
