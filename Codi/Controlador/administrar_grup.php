<?php
require_once("../Vista/index_professor.php");
require_once("../Model/model.php");

if(isset($_GET['accio'])){
    $accion = $_GET['accio'];

    switch($accion){
        case "eliminar":

        break;
        case "crear":
            $grupos = obtenirGrups()->fetchAll();
            $id = count($grupos) + 1;
            $nombre = "Grup-".$id;
            $imagen = "";
            $puntuacion = 0;
            $profeId = 1; //Cambiar id al de sesión.
            
            crearGrup($id, $nombre, $imagen, $puntuacion, $profeId);
            break;
        default:

        break;
    }
}

?>
<script>
    location.replace("../Vista/index_professor.php") 
</script>