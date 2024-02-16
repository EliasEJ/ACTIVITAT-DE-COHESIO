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


?>