<?php
require_once '../Model/model_alumne.php';

function obtenerNombreAlumno($email) {
    $nombre = obtenirNomAlumne($email);
    if ($nombre instanceof PDOStatement) {
        $resultado = $nombre->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['nom'];
        }
    }
    return null;
}

function obtenerGrupoAlumno($email) {
    $grupo = obtenirGrupAlumne($email);
    if ($grupo instanceof PDOStatement) {
        $resultado = $grupo->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['grup_id'];
        }
    }
    return null;
}

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

function obtenerGrupos() {
    $grupos = obtenirIdGrups();
    if ($grupos instanceof PDOStatement) {
        $resultado = $grupos->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function generarBotones($grupos) {
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

function generarModales($grupos) {
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    return $modales;
}

function verificarAsistencia($email, $asistencia) {
    $consulta = verificarAsistenciaAlumne($email, $asistencia);
    if ($consulta instanceof PDOStatement) {
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return true;
        }
    }
    return false;
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    return $modales;
}

// Esta funcion no se usa en ningun lado pero se deja por si acaso se necesita para la siguiente entrega
function obtenerActividadAlumno($email) {
    $actividad = obtenirActivitatAlumne($email);
    if ($actividad instanceof PDOStatement) {
        $resultado = $actividad->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['actividad_id'];
        }
    }
    return null;
}

