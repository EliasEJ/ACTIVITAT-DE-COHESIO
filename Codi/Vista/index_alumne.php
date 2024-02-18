<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTIVITAT DE COHESIÓ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link rel="stylesheet" href="../../Recursos/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Recursos/CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<?php
session_start();
require_once '../Controlador/controlador_alumne.php';

$email = $_SESSION['email'];
$asistencia = verificarAsistencia($email, false);

if ($asistencia) {
    echo '<script type="text/javascript">$(document).ready(function() {$("#asistenciaModal").modal("show");});</script>';
}
?>

<div class="modal fade" id="asistenciaModal" tabindex="-1" role="dialog" aria-labelledby="asistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asistenciaModalLabel">Confirmació d' assistència</h5>
            </div>
            <div class="modal-body">
            <h5>Assistiràs a l'esdeveniment ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="confirmarAsistencia">Sí, assistiré</button>
                <button type="button" class="btn btn-danger" id="negarAsistencia">No, no assistiré</button>
            </div>
        </div>
    </div>
</div>

<script>
$("#confirmarAsistencia").click(function() {
    $.ajax({
        url: "../Controlador/controlador_alumne.php",
        type: "POST",
        data: { email: "<?php echo $email; ?>", asistencia: true },
        success: function() {
            $("#asistenciaModal").modal("hide");
        }
    });
});

$("#negarAsistencia").click(function() {
    $.ajax({
        url: "../Controlador/controlador_alumne.php",
        type: "POST",
        data: { email: "<?php echo $email; ?>", asistencia: false },
        success: function() {
            $("#asistenciaModal").modal("hide");
        }
    });
});
</script>

<div class="row g-0">
    <div class="col-12">
        <nav class="navbar navbar-dark">
            <div class="col-3">
                <a href="../index.php">
                    <img src="../../Recursos/IMG/logo-sapalomera.png" alt="logo sapalomera" width="300px" class="imgHeader">
                </a>
            </div>
            <div class="col-6 "></div>
            <div class="col-3 text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        $email = $_SESSION['email'];
                        $nombre = obtenerNombreAlumno($email);
                        if ($nombre) {echo $nombre; }
                        ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="marginTop">
    <div class="row g-0">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="col-10">
                <h2 class="marginLeft pb-1">EL TEU GRUP</h2>
                <div class="marginLeft grup border">
                    <div class="p-3">
                        <?php
                        $grup = obtenerGrupoAlumno($email);
                        if ($grup) { echo 'GRUP ' . $grup; } ?>
                    </div>


                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn" data-toggle="modal" data-target="#infoGrupModal">
                        <b>INFO</b>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="infoGrupModal" tabindex="-1" role="dialog" aria-labelledby="infoGrupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoGrupModalLabel">Informació del Grup</h5>
                                </div>
                                <div class="modal-body">
                                    <?php $infoGrupo = obtenerInformacionGrupo($grup);
                                    echo generarTabla($infoGrupo);
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <h2 class="marginLeft pt-3">GRUPS</h2>
                <div id="grups">
                    <div class="tbodyDivG ">
                        <table class="table table-striped marginLeft">
                            <thead class="sticky-top bg-white">
                            </thead>
                            <tbody>
                                <?php
                                $grupos = obtenerGrupos();
                                if ($grupos) {echo generarBotones($grupos);} ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                    <?php
                        $grupos = obtenerGrupos();
                        if ($grupos) { echo generarModales($grupos); } ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="col-10">
            <h2 class="marginLeft pb-1">ACTIVITATS</h2>
                <div class="marginLeft grup border">
                    <div class="p-3">
                        <?php
                        $grup = obtenerGrupoAlumno($email);
                        if ($grup) { echo 'GRUP ' . $grup; } ?>
                    </div>


                    <button type="button" class="btn" data-toggle="modal" data-target="#infoGrupModal">
                        <b>INFO</b>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="infoGrupModal" tabindex="-1" role="dialog" aria-labelledby="infoGrupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="infoGrupModalLabel">Informació del Grup</h5>
                                </div>
                                <div class="modal-body">
                                    <?php $infoGrupo = obtenerInformacionGrupo($grup);
                                    echo generarTabla($infoGrupo);
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                
        </div>
    </div>
</div>

<footer class="footer">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 contacte">
            <h4 class="marginLeft">UBICACIÓ</h4>
            <button class="btn btn-primary marginLeft">Mapa <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="36" height="36" viewBox="0 0 256 256" xml:space="preserve">

                    <defs>
                    </defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path d="M 45 0 c 15.103 0 27.389 12.287 27.389 27.389 C 72.389 46.616 46.147 66.607 45 90 c -1.147 -23.393 -27.389 -43.384 -27.389 -62.611 C 17.611 12.287 29.897 0 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,80,80); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <circle cx="45.004999999999995" cy="26.575000000000003" r="9.205" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(191,0,3); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) " />
                    </g>
                </svg></button>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 contacte">
            <h4 class="marginLeft">CONTACTE</h4>
            <p class="marginLeft">Telèfon: <a href="tel:+34 972 350 909">972 350 909</a></p>
            <p class="marginLeft">Email: <a href="mailto:info@sapalomera.cat">info@sapalomera.cat</a></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 contacte">
            <h4>IDIOMES</h4>
            <img width="54" alt="Flag of Catalonia" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Catalonia.svg/64px-Flag_of_Catalonia.svg.png">
            <img width="54" alt="Flag of Spain" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Flag_of_Spain.svg/64px-Flag_of_Spain.svg.png">
        </div>
    </div>
</footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>