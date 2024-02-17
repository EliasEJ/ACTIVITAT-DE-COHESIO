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

