<?php
require_once("../Vista/index_professor.php");
require_once("../Model/model.php");


$grupos = obtenirGrups()->fetchAll();
$id = count($grupos) +1;
$nombre = "Grup-".$id;
$imagen = "";
$puntuacion = 0;
$profeId = 1; //Cambiar id al de sesión.

crearGrup($id, $nombre, $imagen, $puntuacion, $profeId);
?>
<script>
    location.replace("../Vista/index_professor.php") 
</script>