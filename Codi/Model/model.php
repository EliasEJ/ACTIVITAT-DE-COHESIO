<?php
    function connect(){

        try {
            $connexio = new PDO('mysql:host=localhost;dbname=projecte2', 'root', '');
            return $connexio;
        } catch (PDOException $e) { //
            echo "Error: " . $e->getMessage();
        }
    }
    function isAlumne($email){
        $connexio = connect();
        $sql = "SELECT * FROM alumne WHERE correu = '$email'";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
        $connexio = null;
    }
    function isProfessor($email){
        $connexio = connect();
        $sql = "SELECT correu FROM professor WHERE correu = '$email'";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
        $connexio = null;
    }
    function isAdmin($email){
        $connexio = connect();
        $sql = "SELECT correu FROM admin WHERE correu = '$email'";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
        $connexio = null;
    }
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

?>
