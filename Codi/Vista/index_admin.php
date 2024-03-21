<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTIVITAT DE COHESIÓ</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link rel="stylesheet" href="../../Recursos/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../../Recursos/CSS/styleProfessor.css  ">
    <script type="module" src="../Controlador/controlador_professor1.js"> </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script type="module" src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<?php

include_once("../Controlador/controlador_professor.php");
include_once("../Controlador/controlador_admin.php");
$idProfessor = obtenerIdProfessor();
?>


<body>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark">
                    <div class="col-3">
                        <a">
                            <img src="../../Recursos/IMG/logo-sapalomera.png" alt="logo sapalomera" width="300px" class="imgHeader">
                            </a>
                    </div>
                    <div class="col-3 text-center">

                        <?php mostrarUsuariAdmin($idProfessor) ?>

                    </div>

                </nav>

            </div>

        </div>


        <div class="container marginTop">
            <div class="row">
                <ul class="nav nav-tabs" id="tabProfessor">
                    <li class="nav-item">
                        <button class="nav-link active" id="tabAlumnat" data-bs-toggle="tab" data-bs-target="#taulaAlumnat">Alumnat</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#taulaActivitats">Activitats</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#taulaGrups">Grups</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#taulaClassificació">Classificació</button>
                    </li>
                </ul>
                <div class="tab-content" id="contingutTab">
                    <div class="tab-pane fade show active" id="taulaAlumnat">
                        <table class="table table-striped" id="myTable">
                            <thead class="sticky-top bg-white">
                                <tr>
                                    <th>Cognoms, Nom</th>
                                    <th>Grup</th>
                                    <th>Asistencia</th>
                                    <th>Confirmació</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php mostrarAlumnes(); ?>
                            </tbody>
                        </table>
                        <!-- Button trigger modal -->
                        <button type="button" id="añadirAlumn" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Afegir alumne
                        </button>
                        <form action="../Controlador/administrar_alumnado.php" method="post">
                        <input type="submit" name="guardarAsistencia" class="btn btn-primary" value="Salvar"> 
                        </form>

                        
                    </div>
                    <div class="tab-pane fade" id="taulaActivitats">
                        <div class="row">
                            <?php mostrarAdministrarActivitat($idProfessor); ?>

                            <div class="col">
                                <div class="accordion accordion-flush" id="accordionActivitatsPadre">
                                    <h3>Activitats</h3>
                                    <?php mostrarActivitats(); ?>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col">
                                    <button class="btn btn-primary">Generar ordre d'activitats als grups</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="taulaGrups">
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Grup</th>
                                        <th>Tutor</th>
                                        <th>Curs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php mostrarGrupos(); ?>
                                </tbody>
                            </table>
                            <button>Generar els grups</button>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="taulaClassificació">
                        <table class="table table-striped">
                            <thead class="sticky-top bg-white">
                                <tr>
                                    <th>Posició</th>
                                    <th>Grup</th>
                                    <th>Puntuació</th>
                                    <th>Classe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php mostrarClassificació() ?>
                            </tbody>
                        </table>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="modalAñadirAlumn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="" action="../Controlador/administrar_alumnado.php" method="POST">
                                        <label for="newAlumnNombre" class="right">Nom alumne: </label>
                                        <input type="text" name="newAlumnNombre" id="newAlumnNombre"><br> <br>

                                        <label for="newAlumnApellidos" class="right">Cognom/s alumne: </label>
                                        <input type="text" name="newAlumnApellidos" id="newAlumnApellidos"><br><br>

                                        <label for="newAlumnCorreu" class="right">Correu alumne: </label>
                                        <input type="text" name="newAlumnCorreu" id="newAlumnCorreu"><br><br>

                                        <label for="newAlumnGrupo" class="right">Grup</label>
                                        <?php seleccionGruposNuevoAlumno($idProfessor) ?>
                                        <br><br>
                                        <input class="btn btn-primary" type="submit" name="guardarAlumno" value="Save changes">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="cerrarModalAñadirAlumn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
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
                    <a href="../../Recursos/IMG/mapa.JPG" class="boto" target="_blank"><button class="btn btn-primary marginLeft">Mapa <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="36" height="36" viewBox="0 0 256 256" xml:space="preserve"></a>
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
    <script>
        let table = new DataTable('#myTable');
    </script>

</body>

</html>