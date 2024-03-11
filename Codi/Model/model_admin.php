<?php

function obtenirNomAdmin ($email){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT nom FROM admin WHERE correu = $email");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirNomAdmin: " . $e->getMessage();
    }
}
?>