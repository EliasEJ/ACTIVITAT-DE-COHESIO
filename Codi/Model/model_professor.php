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

function obtenirGrupsProfessor($idProfessor){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT g.*
        FROM grup g
        JOIN professor p ON g.grup_id = p.grup_id
        WHERE p.professor_id = :professorId");
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

