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

function verificarAsistenciaAlumne($email, $asistencia) {
    try {
        $con = connect();
        $statement = $con->prepare("UPDATE alumne SET asistencia = :asistencia WHERE correu = :email");
        $statement->execute(
            array(
                ':email' => $email,
                ':asistencia' => $asistencia
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error verificarAsistenciaAlumne: " . $e->getMessage();
    }
}

function obtenirActivitatsA(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT actividad_id FROM activitat");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirActivitats: " . $e->getMessage();
    }
}

function obtenirInfoActivitat($activitatId){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT nom AS NOM, descripcio AS DESCRIPCIO FROM activitat WHERE actividad_id = :activitatId");
        $statement->execute(
            array(
            ':activitatId' => $activitatId
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirInfoActivitat: " . $e->getMessage();
    }
}

// No se usa
function obtenirActivitatAlumne($email){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT actividad_id FROM alumne WHERE correu = :email");
        $statement->execute(
            array(
            ':email' => $email
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirActivitatAlumne: " . $e->getMessage();
    }
}

function actualizarAsistencia($email, $confirmacion) {
    try {
        $con = connect(); // Asegúrate de tener esta función o método definido
        $statement = $con->prepare("UPDATE alumne SET asistencia = :confirmacion WHERE correu = :email");
        $statement->execute(
            array(
                ':email' => $email,
                ':confirmacion' => $confirmacion
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error actualizarAsistencia: " . $e->getMessage();
    }
}

function obtenirOrdreActivitatsA(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT a.actividad_id, a.nom AS actividad_nombre, g.grup_id, ag.nom AS grup_nombre
        FROM activitat AS a
        JOIN 
            grup AS g ON a.grup1 = g.grup_id OR a.grup2 = g.grup_id
        ORDER BY g.grup_id;");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirOrdreActivitats: " . $e->getMessage();
    }
}

function obtenirPuntuacioGrup($grupId){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT puntuacio FROM grup WHERE grup_id = :grupId");
        $statement->execute(
            array(
            ':grupId' => $grupId
            )
        );
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirPuntuacioGrup: " . $e->getMessage();
    }
}
