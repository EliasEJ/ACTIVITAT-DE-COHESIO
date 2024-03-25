<?php

require_once("../Vista/index_professor.php");
require_once("../Model/model_activitat.php");
require_once("../Model/model.php");

if (isset($_GET['accio'])) {
    $accion = $_GET['accio'];
    //echo "get enviado";
    switch ($accion) {
        case 'delete':
            $idAct = $_GET['idAct'];
            eliminarActividad($idAct);
            ?>
            <script>
                alert("Activitat eliminat correctament.");
            </script>
            <?php


            break;
        case 'crear':
            /** 
            $actividades = obtenirActivitats()->fetchAll();
            $newId = count($actividades) +1;
            crearActividad($newId,"","","",$_SESSION['idProfe'],NULL,NULL,"");
             */
            break;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //echo "post enviado";
    guardarActividad();
} else echo "nada";

function guardarActividad()
{
    try {

        $idAct = $_POST['idAct'];
        $nameAct = $_POST['nomAct'];
        $descriptAct = $_POST['descripcioAct'];
        $material_id = $_POST['materialActProf'];
        $comprado = $_POST['comprarMaterial'];
        
        actualizarActividad($idAct, $nameAct, $descriptAct, $material_id);
        actualizarComprarMaterial($material_id, $comprado);
        ?>
        <script>
            alert("La teva activitat ha sigut actualitzada correctament.");
        </script>
        <?php
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
    location.replace("../Vista/index_professor.php")
</script>