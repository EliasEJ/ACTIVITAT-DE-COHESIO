<?php
function actualizarActividad($id, $nombre, $descripcion){
    try{
        $con = connect();
        $statement = $con->prepare("UPDATE activitat SET nom = :nombreAct, descripcio = :descAct WHERE actividad_id = :idAct");
        $statement->execute(
            array(
                ':nombreAct' => $nombre,
                ':descAct' => $descripcion,
                ':idAct' => $id
            )
        );
    }catch(PDOException $e){
        echo "Error actualizarActividad: " . $e->getMessage();
    }
}

function crearActividad($id, $nombre, $descripcion, $posicion_id, $professor_id, $grup1, $grup2, $material_id){
    try{
        $con = connect();
        $statement = $con->prepare("INSERT INTO activitat (actividad_id, nom, descripcio, posicion_id, professor_id, grup1, grup2, material_id)
        VALUES (:idAct, :nombreAct, :descAct, :posAct, :profAct, :grup1, :grup2, :materialId)");
        $statement->execute(
            array(
                ':idAct' => $id,
                ':nombreAct' => $nombre,
                ':descAct' => $descripcion,
                ':posAct' => $posicion_id,
                ':profAct' => $professor_id,
                ':grup1' => $grup1,
                ':grup2' => $grup2,
                ':materialId' => $material_id
            )
        );
    }catch(PDOException $e){
        echo "Error crearActividad: " . $e->getMessage();
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

function eliminarActivitat($id){
    try{
        $con = connect();
        $statement = $con->prepare("DELETE FROM `activitat` WHERE actividad_id = :idAct");
        $statement->execute(
            array(
                ':idAct' => $id
            )
        );
        reordenarActividades();
    }catch(PDOException $e){
        echo "Error eliminarActivitat: " . $e->getMessage();
    }
    
}

function reordenarActividades()
{
    try {
        $connexio = connect();
        $statement = $connexio->prepare("ALTER TABLE activitat DROP actividad_id");
        $statement->execute();
        $statement = $connexio->prepare("ALTER TABLE activitat AUTO_INCREMENT = 1");
        $statement->execute();
        $statement = $connexio->prepare("ALTER TABLE activitat ADD actividad_id int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
        $statement->execute();
    } catch (PDOException $e) { //
        // mostrarem els errors
        echo "Error: " . $e->getMessage();
    }
}
