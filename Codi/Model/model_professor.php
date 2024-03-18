<?php
include_once("../Model/model.php");

function obtenirProfessorUnic($idProfessor)
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM professor WHERE professor_id = :idProfessor");
        $statement->execute(
            array(
                ':idProfessor' => $idProfessor
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirProfessorUnic: " . $e->getMessage();
    }
}

function obtenirProfessorUnicEmail($emailProfessor)
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM professor WHERE correu = :emailProfessor");
        $statement->execute(
            array(
                ':emailProfessor' => $emailProfessor
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirProfessorUnic: " . $e->getMessage();
    }
}

function obtenirGrupsProfessor($idProfessor)
{
    try {
        $con = connect();
        $statement = $con->prepare("SELECT * FROM grup WHERE id_professor_encarregat = :professorId");
        $statement->execute(
            array(
                ':professorId' => $idProfessor
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error obtenirGrupsProfessor: " . $e->getMessage();
    }
}


//TERMINAR
function crearAlumno($idAlumn, $nomAlumn, $cognomAlumn, $correuAlumn, $curs, $any, $classe, $asistencia, $confirmarAsistencia, $grupId, $idProfessor)
{
    try {
        $con = connect();
        $statement = $con->prepare("INSERT INTO alumne(alumne_id, nom, cognom, correu, curs, any, classe, asistencia, asistencia_confirmada, grup_id, tutor)
        VALUES (:alumne_id, :nomAlumn, :cognomsAlumn, :correuAlumn, :curs, :any, :classe, :asistencia, :confirm,:grup_id, :tutor )");
        $statement->execute(
            array(
                ':alumne_id' => $idAlumn,
                ':nomAlumn' => $nomAlumn,
                ':cognomsAlumn' => $cognomAlumn,
                ':correuAlumn' => $correuAlumn,
                ':curs' => $curs,
                ':any' => $any,
                ':classe' => $classe,
                ':asistencia' => $asistencia,
                ':confirm' => $confirmarAsistencia,
                ':grup_id' => $grupId,
                ':tutor' => $idProfessor
            )
        );
        return $statement;
    } catch (PDOException $e) {
        echo "Error crearAlumno: " . $e->getMessage();
    }
}

function actualizarAsistencia($alumno_id, $asistencia)
{
    try {
        $con = connect();
        $statement = $con->prepare("UPDATE alumne
    SET asistencia_confirmada = :asistencia
    WHERE alumne_id = :alumneId");

        $statement->execute(
            array(
                ':asistencia' => $asistencia,
                ':alumneId' => $alumno_id
            )
        );
    } catch (PDOException $e) {
        echo "Error actualizarAsistencia: " . $e->getMessage();
    }
}
