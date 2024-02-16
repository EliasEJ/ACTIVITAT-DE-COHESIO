<?php
include_once("../Model/model_activitat.php");


function crearActivitat(){
    $count = obtenirActivitats()->fetchAll();
    $newId = count($count) + 1;
}


?>