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

function obtenirActivitatUnic($idProfessorResp){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM activitat WHERE professor_id = :idProfessor");
        $statement->execute(
            array(
                ':idProfessor' => $idProfessorResp
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirActivitatUnic: " . $e->getMessage();
    }
}

