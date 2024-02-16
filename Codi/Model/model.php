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
        $sql = "SELECT correu FROM alumne";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if($row['correu'] == $email){
                return true;
            }else{
                return false;
            }
        }
        $connexio = null;
    }
    function isProfessor($email){
        $connexio = connect();
        $sql = "SELECT correu FROM professor";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if($row['correu'] == $email){
                return true;
            }else{
                return false;
            }
        }
        $connexio = null;
    }
    function isAdmin($email){
        $connexio = connect();
        $sql = "SELECT correu FROM admin";
        $result = $connexio->query($sql);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if($row['correu'] == $email){
                return true;
            }else{
                return false;
            }
        }
        $connexio = null;
    }


?>