<?php

require_once("../Vista/index_professor.php");
require_once("../Model/model_activitat.php");


if (isset($_GET['accio'])) {
    $accion = $_GET['accio'];
    echo "get enviado";
    switch ($accion) {
        case 'delete':
            $idAct = $_GET['idAct'];
            eliminarActividad($idAct);
            break;
        
    }
} else if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "post enviado";
    guardarActividad();
}else echo "nada";

function guardarActividad()
{
    try {
        
        $idAct = $_POST['idAct'];
        $nameAct = $_POST['nomAct'];
        $descriptAct = $_POST['descripcioAct'];

        echo $idAct;
        echo $nameAct;
        echo $descriptAct;

        actualizarActividad($idAct, $nameAct, $descriptAct);
    } catch (PDOException $e) {
        echo "Error guardarActividad: " . $e->getMessage();
    }
}

function eliminarActividad($idActividad)
{
    try {
        eliminarActivitat($idActividad);
    } catch (PDOException $e) {
        echo "Error eliminarActividad: " . $e->getMessage();
    }
}

?>
<script>
    //location.replace("../Vista/index_professor.php") 
</script>