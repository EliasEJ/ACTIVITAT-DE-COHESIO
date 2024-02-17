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

?>