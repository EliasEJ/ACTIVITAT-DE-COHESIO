<?php
require_once '../Model/model_alumne.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmacion'])) {
    $confirmacion = ($_POST['confirmacion'] == 1) ? 1 : 0;
    
    // Obtener el email del usuario desde la sesión
    $email = $_SESSION['email'];

    // Utilizar la función del modelo para actualizar la asistencia
    actualizarAsistencia($email, $confirmacion);

    // Establecer una cookie para evitar mostrar el modal nuevamente
    setcookie('asistencia_confirmada', 'true', time() + 3600 * 24 * 30); // Expira en 30 días
}

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
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tancar</button>
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
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }
    return $modales;
}

function obtenirOrdreActivitats() {
    $ordre = obtenirOrdreActivitatsA();
    if ($ordre instanceof PDOStatement) {
        $resultado = $ordre->fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }
    }
    return null;
}

function generaraTablaOrdre($ordre) {
    $tabla = "";
    if ($ordre) {
        $tabla .= "<table class='table'>";
        $tabla .= "<thead>";
        $tabla .= "<tr>";
        foreach ($ordre[0] as $key => $value) {
            $tabla .= "<th>$key</th>";
        }
        $tabla .= "</tr>";
        $tabla .= "</thead>";
        $tabla .= "<tbody>";
        foreach ($ordre as $actividad) {
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

function obtenirPuntuacion($grupId) {
    $puntuacion = obtenirPuntuacioGrup($grupId);
    if ($puntuacion instanceof PDOStatement) {
        $resultado = $puntuacion->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado['puntuacio'];
        }
    }
    return null;
}

function mostrarPuntuacion($grupId) {
    $puntuacion = obtenirPuntuacion($grupId);
    if ($puntuacion !== null) {
        echo "<h2>Puntuació</h2>";
        echo "<div class='mb-4'><p>Puntuació del grup $grupId: <b>$puntuacion punts</b></p></div>";
    } else {
        echo "<p style='color:red;'>No se pudo obtener la puntuación del grupo $grupId.</p>";
    }
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