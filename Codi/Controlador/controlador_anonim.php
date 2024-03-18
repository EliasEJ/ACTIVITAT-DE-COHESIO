<?php

function obtenerInformacionGrupo($grupoId) {
    $infoGrupo = obtenirInfoGrup($grupoId);
    if ($infoGrupo instanceof PDOStatement) {
        $resultado = $infoGrupo->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function obtenirInfoGrup($grupoId){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT alumne_id AS ID, nom AS NOM, cognom AS COGNOM, CONCAT(any, ' ', classe, ' ', curs) as CURS FROM alumne WHERE grup_id = :grupoId");
        $statement->execute(
            array(
            ':grupoId' => $grupoId
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirInfoGrup: " . $e->getMessage();
    }
}

function generarTabla($infoGrupo) {
    $tabla = "";
    if ($infoGrupo) {
        $tabla .= "<table class='table'>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        foreach ($infoGrupo[0] as $key => $value) {
            $tabla .= "<th>$key</th>";
        }
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach ($infoGrupo as $alumno) {
            $tabla .= "<tr>";
            foreach ($alumno as $value) {
                $tabla .= "<td>$value</td>";
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
    }
    return $tabla;
}

function connect(){

    try {
        $connexio = new PDO('mysql:host=localhost;dbname=projecte2', 'root', '');
        return $connexio;
    } catch (PDOException $e) { //
        echo "Error: " . $e->getMessage();
    }
}

function obtenirIdGrups() {
    try {
        $con = connect();
        $statement = $con->prepare("SELECT grup_id FROM grup");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrups: " . $e->getMessage();
    }
}

function obtenerGruposA() {
    $grupos = obtenirIdGrups();
    if ($grupos instanceof PDOStatement) {
        $resultado = $grupos->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function generarBotonesA($grupos) {
    $botones = "";
    foreach ($grupos as $grupo) {
        $botones .= "<tr>";
        $botones .= "<td>Grup " . $grupo['grup_id'] . "</td>";
        $botones .= "<td class='mrb'>";
        $botones .= '<button type="button" class="btn " data-toggle="modal" data-target="#infoGrupModalID' . $grupo['grup_id'] . '">
                        <b>INFO</b>
                      </button>';
        $botones .= "</td>";
        $botones .= "</tr>";
    }
    return $botones;
}

function generarModalesA($grupos) {
    $modales = "";
    foreach ($grupos as $grupo) {
        $modalID = "infoGrupModalID" . $grupo['grup_id'];
        $modales .= '<div class="modal fade" id="' . $modalID . '" tabindex="-1" role="dialog" aria-labelledby="' . $modalID . '" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="' . $modalID . '">Informació del Grup ' . $grupo['grup_id'] . '</h5>
                                </div>
                                <div class="modal-body">';
                                $infoGrupo = obtenerInformacionGrupo($grupo['grup_id']);
                                $modales .= generarTabla($infoGrupo);
                                $modales .= '</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    return $modales;
}

function obtenerActividades() {
    $actividades = obtenirActivitatsA();
    if ($actividades instanceof PDOStatement) {
        $resultado = $actividades->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function obtenirActivitatsA(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM activitat");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirActivitats: " . $e->getMessage();
    }
}

function generarBotonesActivitats($actividades) {
    $botones = "";
    foreach ($actividades as $actividad) {
        $botones .= "<tr>";
        $botones .= "<td>Activitat " . $actividad['actividad_id'] . "</td>";
        $botones .= "<td class='mrb'>";
        $botones .= '<button type="button" class="btn " data-toggle="modal" data-target="#infoActivitatModalID' . $actividad['actividad_id'] . '">
                        <b>INFO</b>
                      </button>';
        $botones .= "</td>";
        $botones .= "</tr>";
    }
    return $botones;
}

function generarTablaActividad($infoActividad) {
    $tabla = "";
    if ($infoActividad) {
        $tabla .= "<table class='table'>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        foreach ($infoActividad[0] as $key => $value) {
            $tabla .= "<th>$key</th>";
        }
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach ($infoActividad as $actividad) {
            $tabla .= "<tr>";
            foreach ($actividad as $value) {
                $tabla .= "<td>$value</td>";
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
    }
    return $tabla;
}

function obtenerInfoActividad($actividadId) {
    $infoActividad = obtenirInfoActivitat($actividadId);
    if ($infoActividad instanceof PDOStatement) {
        $resultado = $infoActividad->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function obtenirInfoActivitat($activitatId){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT nom AS NOM, descripcio AS DESCRIPCIO FROM activitat WHERE actividad_id = :activitatId");
        $statement->execute(
            array(
            ':activitatId' => $activitatId
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirInfoActivitat: " . $e->getMessage();
    }
}
function generarModalesActivitats($actividades) {
    $modales = "";
    foreach ($actividades as $actividad) {
        $modalID = "infoActivitatModalID" . $actividad['actividad_id'];
        $modales .= '<div class="modal fade" id="' . $modalID . '" tabindex="-1" role="dialog" aria-labelledby="' . $modalID . '" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="' . $modalID . '">Informació de l\'Activitat ' . $actividad['actividad_id'] . '</h5>
                                </div>
                                <div class="modal-body">';
                                $infoActividad = obtenerInfoActividad($actividad['actividad_id']);
                                $modales .= generarTablaActividad($infoActividad);
                                $modales .= '</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    return $modales;
}
