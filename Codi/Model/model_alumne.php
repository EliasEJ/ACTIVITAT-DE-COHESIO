<?php
include_once("../Model/model.php");
function obtenirNomAlumne($email){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT nom FROM alumne WHERE correu = :email");
        $statement->execute(
            array(
            ':email' => $email
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirNomAlumne: " . $e->getMessage();
    }
}

function obtenirGrupAlumne($email){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT grup_id FROM alumne WHERE correu = :email");
        $statement->execute(
            array(
            ':email' => $email
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirGrupAlumne: " . $e->getMessage();
    }
}

function obtenirInfoGrup($grupoId){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT alumne_id AS ID, nom AS NOM, cognom AS COGNOM, CONCAT(any, ' ', classe, ' ', curs) as CURS FROM alumne WHERE grup_id = :grupoId");
        $statement->execute(
            array(
            ':grupoId' => $grupoId
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirInfoGrup: " . $e->getMessage();
    }
}

function obtenirIdGrups() {
    try {
        $con = connect();
        $statement = $con->prepare("SELECT grup_id FROM grup");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrups: " . $e->getMessage();
    }
}

function crearGrup($grupId, $nom, $foto, $puntuacio, $idProfessor){
    try{
        $con = connect();
        $statement = $con->prepare("INSERT INTO grup (grup_id, nom, foto, puntuacio, id_professor_encarregat)
        VALUES (:grupId, :nom, :foto, :puntuacion, :idProfessor)");
        $statement->execute(
            array(
                ':grupId' => $grupId,
                ':nom' => $nom,
                ':foto' => $foto,
                ':puntuacion' => $puntuacio,
                ':idProfessor' => $idProfessor,
            )
        );
    }catch(PDOException $e){
        echo "Error crearGrup: " . $e->getMessage();
    }
}
