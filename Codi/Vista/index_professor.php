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
</head>

<?php

include_once("../Controlador/controlador_professor.php");
$idProfessor = obtenerIdProfessor();
?>


<body>
<?php
    if(!començar()){
    ?>
    <div class="content">
        <div class="row g-0">
            <div class="col-12">
                <nav class="navbar navbar-dark">
                    <div class="col-3">
                        <a">
                            <img src="../../Recursos/IMG/logo-sapalomera.png" alt="logo sapalomera" width="300px" class="imgHeader">
                            </a>
                    </div>
                    <div class="col-3 text-center">

                        <?php mostrarUsuari($idProfessor) ?>

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
                        <form action="../Controlador/administrar_alumnado.php" method="post">

                            <table class="table table-striped">
                                <thead class="sticky-top bg-white">
                                    <tr>
                                        <th>Cognoms, Nom</th>
                                        <th>Grup</th>
                                        <th>Asistencia Alumne</th>
                                        <th>Confirmació Alumne</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php mostrarAlumnat($idProfessor); ?>
                                </tbody>
                            </table>

                            <input type="submit" name="guardarAsistencia" class="btn btn-success w-100 mt-2" value="Guardar"> 
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" id="añadirAlumn" class="btn btn-primary w-100 mt-2" data-toggle="modal" data-target="#exampleModalCenter">
                            Afegir alumne
                        </button>

                    </div>
                    <div class="tab-pane fade" id="taulaActivitats">
                        <div class="row">
                            <?php mostrarAdministrarActivitat($idProfessor); ?>

                            <div class="col">
                                <div class="accordion accordion-flush" id="accordionActivitatsPadre">
                                    <h3>Activitats</h3>
                                    <?php mostrarActivitats(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="taulaGrups">
                        <div class="row">
                            <?php mostrarGruposTutorProfe($idProfessor) ?>
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
                                    <h5 class="modal-title" id="exampleModalLongTitle">Afegir alumne</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="" action="../Controlador/administrar_alumnado.php" method="POST">
                                        <div class="form-group">
                                            <label for="newAlumnNombre" class="w-100">Nom alumne: </label>
                                            <input type="text" class="form-control" name="newAlumnNombre" id="newAlumnNombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="newAlumnApellidos" class="w-100 mt-2">Cognom/s alumne: </label>
                                            <input type="text" class="form-control" name="newAlumnApellidos" id="newAlumnApellidos">
                                        </div>
                                        <div class="form-group">
                                            <label for="newAlumnCorreu" class="w-100 mt-2">Correu alumne: </label>
                                            <input type="text" class="form-control" name="newAlumnCorreu" id="newAlumnCorreu">
                                        </div>
                                        <div class="form-group">
                                            <label for="newAlumnGrupo" class="w-100 mt-2">Grup</label>
                                            <?php seleccionGruposNuevoAlumno($idProfessor) ?>
                                        </div>
                                        <br><br>    
                                        <input class="btn btn-primary" type="submit" name="guardarAlumno" value="Guardar">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="cerrarModalAñadirAlumn" class="btn btn-secondary" data-dismiss="modal">Cancel·lar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
        <div class="row pt-4 g-0">
        <div class="col-lg-4 col-md-4 col-sm-12 contacte">
            <h4 class="marginLeft">UBICACIÓ</h4>
            <button class="btn btn-primary marginLeft" data-toggle="modal" data-target="#mapaModal">Mapa <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="36" height="36" viewBox="0 0 256 256" xml:space="preserve">
                    <defs>
                    </defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path d="M 45 0 c 15.103 0 27.389 12.287 27.389 27.389 C 72.389 46.616 46.147 66.607 45 90 c -1.147 -23.393 -27.389 -43.384 -27.389 -62.611 C 17.611 12.287 29.897 0 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,80,80); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        <circle cx="45.004999999999995" cy="26.575000000000003" r="9.205" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(191,0,3); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) " />
                    </g>
                </svg>
            </button>

            <div class="modal fade" id="mapaModal" tabindex="-1" role="dialog" aria-labelledby="mapaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mapaModalLabel">Mapa</h5>
                        </div>
                        <div class="modal-body">
                            <?php 
                            $posicio = generaraPosMap();
                            mostrarPosMap($posicio);
                            ?>
                            <img src="../../Recursos/IMG/mapa.JPG" alt="Mapa" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tancar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-4 col-md4 contacte">
                <h4 class="marginLeft">CONTACTE</h4>
                <p class="marginLeft">Telèfon: <a href="tel:+34 972 350 909">972 350 909</a></p>
                <p class="marginLeft">Email: <a href="mailto:info@sapalomera.cat">info@sapalomera.cat</a></p>
            </div>
            <div class="col-4 col-md4 contacte">
                <h4>IDIOMES</h4>
                <img width="54" alt="Flag of Catalonia" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Flag_of_Catalonia.svg/64px-Flag_of_Catalonia.svg.png">
                <img width="54" alt="Flag of Spain" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Flag_of_Spain.svg/64px-Flag_of_Spain.svg.png">
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    }else{
    ?>
    <div>
        <?php
        puntuar();
        ?>
    </div>
    <?php
    }
    ?>
</body>

</html>