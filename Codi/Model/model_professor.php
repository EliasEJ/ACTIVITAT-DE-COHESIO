<?php 
include_once("../Model/model.php");

function obtenirProfessorUnic($idProfessor){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM professor WHERE professor_id = :idProfessor");
        $statement->execute(
            array(
                ':idProfessor' => $idProfessor
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirProfessorUnic: " . $e->getMessage();
    }
}

function obtenirProfessorUnicEmail($emailProfessor){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM professor WHERE correu = :emailProfessor");
        $statement->execute(
            array(
                ':emailProfessor' => $emailProfessor
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirProfessorUnic: " . $e->getMessage();
    }
}

function obtenirGrupsProfessor($idProfessor){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM grup WHERE id_professor_encarregat = :professorId");
        $statement->execute(
            array(
                ':professorId' => $idProfessor
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirGrupsProfessor: " . $e->getMessage();
    }
}