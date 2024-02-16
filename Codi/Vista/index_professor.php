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
    <script type="module" src="../Controlador/controlador_professor2.js"> </script>
    <script type="module" src="../Controlador/controlador_activitat.js"> </script>
</head>

<?php include_once("../Controlador/controlador_professor.php"); ?>

<body>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark">
                    <div class="col-3">
                        <a href="../index.php">
                            <img src="../../Recursos/IMG/logo-sapalomera.png" alt="logo sapalomera" width="300px" class="imgHeader">
                        </a>
                    </div>
                    <div class="col-9 ">
                        <button class="btn btnLogin"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
                                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                </path>
                                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                </path>
                                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                </path>
                                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                </path>
                            </svg>
                            Login with Google
                        </button>
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
                        <table class="table table-striped">
                            <thead class="sticky-top bg-white">
                                <tr>
                                    <th>Cognoms, Nom</th>
                                    <th>Grup</th>
                                    <th>Asistencia</th>
                                    <th>Confirmació</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php mostrarAlumnat(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="taulaActivitats">
                        <div class="row">


                            <?php mostrarAdministrarActivitat(); ?>

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
                            <div class="col">
                                <h3>Grups</h3>
                                <br>
                                
                                    
                                    <?php mostrarGrupsProfessor(); ?>
                                    
                                
                            </div>
                            <div class="col">
                                <h3>Alumnes</h3>
                                <br>
                                <table class="table table-striped">
                                    <thead class="sticky-top bg-white">
                                        <tr>
                                            <th>Alumne</th>
                                            <th>Grup</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php mostrarSeleccioGrupsAlumnes(); ?>
                                    </tbody>
                                </table>


                            </div>

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
</body>

</html>