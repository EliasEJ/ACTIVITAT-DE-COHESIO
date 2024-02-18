<?php
require_once("../Vista/index_professor.php");
require_once("../Model/model.php");
require_once("../Model/model_professor.php");

if(isset($_GET['accio'])){
    $accion = $_GET['accio'];

    switch($accion){
        case "eliminar":
            $grupoId = $_GET['idGrup'];
            //comprobarGrupos($grupoId);
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
}else if($_SERVER["REQUEST_METHOD"] == "POST"){
    foreach ($_POST['alumne_id'] as $alumne_id) {
        // Obtener el nuevo identificador de grupo seleccionado para este alumno
        $nuevo_grup_id = $_POST['grup'][$alumne_id];
        
        modificarGrupUsuari($alumne_id, $nuevo_grup_id);
    }
}

function comprobarGrupos($grupId, $idTutor){
    $grupos = obtenirAlumnat($idTutor);
}

?>
<script>
    location.replace("../Vista/index_professor.php") 
</script>