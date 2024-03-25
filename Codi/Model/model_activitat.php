<?php
function actualizarActividad($id, $nombre, $descripcion, $material_id){
    try{
        $con = connect();
        $statement = $con->prepare("UPDATE activitat SET nom = :nombreAct, descripcio = :descAct, material_id = :material_id WHERE actividad_id = :idAct");
        $statement->execute(
            array(
                ':nombreAct' => $nombre,
                ':descAct' => $descripcion,
                ':idAct' => $id,
                ':material_id' => $material_id
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

function eliminarActivitat($id){
    try{
        $con = connect();
        dropConstraintsActivitat();
        setNullActivitatId($id);
        $statement = $con->prepare("DELETE FROM `activitat` WHERE actividad_id = :idAct");
        $statement->execute(
            array(
                ':idAct' => $id
            )
        );
        addConstraintsActivitatId();
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

function dropConstraintsActivitat(){
    try{
        $con = connect();

        $statement = $con->prepare("ALTER TABLE enfrentaments DROP FOREIGN KEY `enfrentaments_ibfk_1`");
        $statement->execute();

        $statement = $con->prepare("ALTER TABLE professor DROP FOREIGN KEY `professor_ibfk_1`");
        $statement->execute();

    }catch (PDOException $e) {
        echo "Error dropConstraintsActivitat: " . $e->getMessage();
    }
}

function setNullActivitatId($activitatId){
    try {
        $con = connect();
        $statement = $con->prepare("UPDATE enfrentaments
        SET actividad_id = NULL
        WHERE actividad_id = :idActividad");
        $statement->execute(array(':idActividad' => $activitatId));

        $statement = $con->prepare("UPDATE professor
        SET actividad_id = NULL
        WHERE actividad_id = :idActividad");
        $statement->execute(array(':idActividad' => $activitatId));
        
    } catch (PDOException $e) {
        echo "Error setNullActivitatId: " . $e->getMessage();
    }
}

function addConstraintsActivitatId(){
    try{
        $con = connect();

        $statement = $con->prepare("ALTER TABLE enfrentaments ADD CONSTRAINT `enfrentaments_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `activitat` (`actividad_id`)");
        $statement->execute();

        $statement = $con->prepare("ALTER TABLE professor ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `activitat` (`actividad_id`)");
        $statement->execute();
       
    }catch (PDOException $e) {
        echo "Error addConstraintsActivitatId: " . $e->getMessage();
    }
    
} 


function obtenerMaterialActividad($actividad_id){
    try{

        $con = connect();

        $statement = $con->prepare("SELECT m.*
        FROM activitat a
        JOIN material m ON a.material_id = m.material_id
        WHERE a.actividad_id = :idActividad;");

        $statement->execute(
            array(
                ':idActividad' => $actividad_id
            )
            );

        return $statement;

    }catch(PDOException $e){
        echo "Error obtenerMaterialActividad: " . $e->getMessage();
    }
}