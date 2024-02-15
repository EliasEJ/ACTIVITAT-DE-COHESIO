<?php 
include_once("../Model/model.php");

function obtenirAlumnat($idTutor){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM alumne WHERE tutor = :idTutor");
        $statement->execute(
            array(
            ':idTutor' => $idTutor
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirAlumnat: " . $e->getMessage();
    }
}

function obtenirActivitats(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM activitat");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirActivitats: " . $e->getMessage();
    }
}

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

function obtenirGrups(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT DISTINCT  a.curs, a.any, a.classe, g.nom, g.puntuacio
        FROM alumne a
        JOIN grup g ON a.grup_id = g.grup_id 
        ORDER BY g.puntuacio DESC");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirGrups: " . $e->getMessage();
    }
}
