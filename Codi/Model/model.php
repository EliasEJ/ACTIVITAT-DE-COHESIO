<?php
function connect()
{

    try {
        $connexio = new PDO('mysql:host=localhost;dbname=projecte2', 'root', '');
        return $connexio;
    } catch (PDOException $e) { //
        echo "Error: " . $e->getMessage();
    }
}
function isAlumne($email)
{
    $connexio = connect();
    $sql = "SELECT * FROM alumne WHERE correu = '$email'";
    $result = $connexio->query($sql);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
    $connexio = null;
}
function isProfessor($email)
{
    $connexio = connect();
    $sql = "SELECT correu FROM professor WHERE correu = '$email'";
    $result = $connexio->query($sql);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
    $connexio = null;
}
function isAdmin($email)
{
    $connexio = connect();
    $sql = "SELECT correu FROM admin WHERE correu = '$email'";
    $result = $connexio->query($sql);
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
    $connexio = null;
}
function obtenirAlumnat($idTutor)
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM alumne WHERE tutor = :idTutor");
        $statement->execute(
            array(
                ':idTutor' => $idTutor
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirAlumnat: " . $e->getMessage();
    }
}

function obtenirActivitats()
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM activitat");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirActivitats: " . $e->getMessage();
    }
}
function obtenirGrupsClasificacio()
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT DISTINCT a.curs, a.any, a.classe, g.nom, g.puntuacio
            FROM alumne a
            JOIN grup g ON a.grup_id = g.grup_id 
            ORDER BY g.puntuacio DESC");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrupsClasificacio: " . $e->getMessage();
    }
}

function obtenirGrupsClasse()
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT DISTINCT a.curs, a.any, a.classe, g.nom, g.puntuacio, g.grup_id
            FROM alumne a
            JOIN grup g ON a.grup_id = g.grup_id");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrupsClasse: " . $e->getMessage();
    }
}

function obtenirGrups()
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM grup");
        $statement->execute();
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrups: " . $e->getMessage();
    }
}

function crearGrup($grupId, $nom, $foto, $puntuacio, $idProfessor)
{
    try {
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
    } catch (PDOException $e) {
        echo "Error crearGrup: " . $e->getMessage();
    }
}

function eliminarGrup($idGrup)
{
    try {
        $con = connect();
        dropConstraintsGrupId();
        $statement = $con->prepare("DELETE FROM grup WHERE grup_id = :idGrup");
        $statement->execute(
            array(
                ':idGrup' => $idGrup
            )
        );
        setNullGrupId($idGrup);
        addConstraintsGrupId();
    } catch (PDOException $e) {
        echo "Error crearGrup: " . $e->getMessage();
    }
}

function dropConstraintsGrupId(){
    try{
        $con = connect();
        $statement = $con->prepare("ALTER TABLE alumne DROP CONSTRAINT `alumne_ibfk_1`
        ALTER TABLE professor DROP CONSTRAINT `professor_ibfk_2`
        ALTER TABLE `admin` DROP CONSTRAINT `admin_ibfk_1`
        ALTER TABLE `activitat` DROP CONSTRAINT `activitat_ibfk_4`
        ALTER TABLE `activitat` DROP CONSTRAINT `activitat_ibfk_5`
        ");
        $statement->execute();
    }catch (PDOException $e) {
        echo "Error dropConstraintsGrupId: " . $e->getMessage();
    }
    
}

function addConstraintsGrupId(){
    try{
        $con = connect();
        $statement = $con->prepare("ALTER TABLE alumne ADD CONSTRAINT `alumne_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`grup_id`)
        ALTER TABLE professor ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`grup_id`)
        ALTER TABLE `admin`ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`grup_id`)
        ALTER TABLE `activitat`
        ADD CONSTRAINT `activitat_ibfk_4` FOREIGN KEY (`grup1`) REFERENCES `grup` (`grup_id`), 
        ADD CONSTRAINT `activitat_ibfk_5` FOREIGN KEY (`grup2`) REFERENCES `grup` (`grup_id`) 
        ");
        $statement->execute();
    }catch (PDOException $e) {
        echo "Error addConstraintsGrupId: " . $e->getMessage();
    }
    
} 

function setNullGrupId($idGrup){
    try {
        $con = connect();
        $statement = $con->prepare("UPDATE alumne
        SET grup_id = NULL
        WHERE grup_id = :idGrup

        UPDATE professor
        SET grup_id = NULL
        WHERE grup_id = :idGrup

        UPDATE `admin`
        SET grup_id = NULL
        WHERE grup_id = :idGrup

        UPDATE `activitat`
        SET grup1 = NULL
        WHERE grup1 = :idGrup

        UPDATE `activitat`
        SET grup2 = NULL
        WHERE grup2 = :idGrup
        ");
        $statement->execute(
            array(
                ':idGrup' => $idGrup
            )
        );
    } catch (PDOException $e) {
        echo "Error setNullGrupId: " . $e->getMessage();
    }
}

function modificarGrupUsuari($idAlumne, $idGrup)
{
    try {
        $con = connect();
        $statement = $con->prepare("UPDATE alumne SET grup_id = :idGrup  
            WHERE alumne_id = :idAlumne");
        $statement->execute(
            array(
                ':idGrup' => $idGrup,
                ':idAlumne' => $idAlumne
            )
        );
    } catch (PDOException $e) {
        echo "Error modificarGrupUsuari: " . $e->getMessage();
    }
}
