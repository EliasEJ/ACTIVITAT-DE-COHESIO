<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTIVITAT DE COHESIÓ</title>
    <link rel="stylesheet" href="../Recursos/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../Recursos/CSS/style.css  ">
    
</head>
<body>
  <div class="content">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-dark">
                <div class="col-3">
                    <img src="../Recursos/IMG/logo-sapalomera.png" alt="logo sapalomera" width="300px" class="imgHeader">
                </div>
                <div class="enlace">
                  <?php require ('../Recursos/autentificacion.php')?>
                  <a href="<?php echo $client->createAuthUrl() ?>">Iniciar sesión con Google</a>
                 </div>
              </nav>
        </div>
    </div>
    
    <div class="row marginTop">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="col-12">
                <h2 class="marginLeft">GRUPS</h2>
                <div class="tbodyDiv marginLeft" >
                <table class="table table-striped marginLeft">
                  <thead class="sticky-top bg-white">
                    <tr>
                      <th>Grups ID</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Grup 1</td>
                    </tr>
                    <tr>
                      <td>Grup 2</td>
                    </tr>
                    <tr>
                      <td>Grup 3</td>
                    </tr>
                    <tr>
                      <td>Grup 4</td>
                    </tr>
                    <tr>
                      <td>Grup 5</td>
                    </tr>
                    <tr>
                      <td>Grup 6</td>
                    </tr>
                    <tr>
                      <td>Grup 7</td>
                    </tr>
                    <tr>
                      <td>Grup 8</td>
                    </tr>
                    <tr>
                      <td>Grup 8</td>
                    </tr>
                    <tr>
                      <td>Grup 8</td>
                    </tr>
                    <tr>
                      <td>Grup 8</td>
                    </tr>
                    <tr>
                      <td>Grup 8</td>
                    </tr>
                  </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="col-12">
                <h2 class="marginLeft">ACTIVITATS</h2>
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
            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
              <path d="M 45 0 c 15.103 0 27.389 12.287 27.389 27.389 C 72.389 46.616 46.147 66.607 45 90 c -1.147 -23.393 -27.389 -43.384 -27.389 -62.611 C 17.611 12.287 29.897 0 45 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,80,80); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
              <circle cx="45.004999999999995" cy="26.575000000000003" r="9.205" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(191,0,3); fill-rule: nonzero; opacity: 1;" transform="  matrix(1 0 0 1 0 0) "/>
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