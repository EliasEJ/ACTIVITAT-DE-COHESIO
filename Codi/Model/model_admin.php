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

function obtenirAlumnes(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM alumne");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirAlumnat: " . $e->getMessage();
    }
}

function mostrarGrupos(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM grup");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error mostrarGrupos: " . $e->getMessage();
    }
}
?>