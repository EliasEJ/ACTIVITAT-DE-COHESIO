<?php

function guardarEnfrentamientos($enfrentamientos){
    try {
        $con = connect();
        foreach ($enfrentamientos as $actividad_id => $enfrentamiento_actividad) {
            foreach ($enfrentamiento_actividad as $enfrentamiento) {
                $grupo1_id = $enfrentamiento[0];
                $grupo2_id = $enfrentamiento[1];
                $statement = $con->prepare("INSERT INTO enfrentaments (actividad_id, grupo1_id, grupo2_id) VALUES (?, ?, ?)");
                $statement->execute([$actividad_id, $grupo1_id, $grupo2_id]);
            }
        }
        echo "Enfrentamientos generados y guardados exitosamente.";
    } catch (PDOException $e) {
        echo "Error al generar y guardar enfrentamientos: " . $e->getMessage();
    }
}

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

function obtenimGrups(){
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