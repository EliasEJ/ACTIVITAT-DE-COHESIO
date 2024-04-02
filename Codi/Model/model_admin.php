<?php
require_once("model.php");

function obtenerProfesoresDisponibles(){

    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM professor WHERE actividad_id IS NULL");
        $statement->execute();
        return $statement;
    }catch (PDOException $e){
        echo "Error obtenerProfesoresDisponibles: " . $e->getMessage();
    }

}

function guardarEnfrentamientos($enfrentamientos){
    try {
        $con = connect();
        foreach ($enfrentamientos as $actividad_id => $enfrentamiento_actividad) {
            foreach ($enfrentamiento_actividad as $enfrentamiento) {
                $grupo1_id = $enfrentamiento[0];
                $grupo2_id = $enfrentamiento[1];
                $statement = $con->prepare("INSERT INTO enfrentaments (actividad_id, grupo1_id, grupo2_id) VALUES (?, ?, ?)");
                $statement->execute([$actividad_id, $grupo1_id, $grupo2_id]);
            }
        }
        echo "Enfrentamientos generados y guardados exitosamente.";
    } catch (PDOException $e) {
        echo "Error al generar y guardar enfrentamientos: " . $e->getMessage();
    }
}

function obtenirNomAdmin ($email){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT nom FROM admin WHERE correu = $email");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirNomAdmin: " . $e->getMessage();
    }
}

function obtenirAlumnes(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM alumne");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error obtenirAlumnat: " . $e->getMessage();
    }
}
function crearActivitat($nom, $idProfessor, $diferencia){
    try{
        $con = connect();
        if($diferencia != 0){
        $statement = $con->prepare("INSERT INTO activitat (nom, posicion_id, professor_id, material_id) VALUES (?, ?, ?, ?)");
        $statement->execute([$nom, 1, $idProfessor, 1]);
        }else{
        $statement = $con->prepare("UPDATE activitat (nom, posicion_id, professor_id, material_id) VALUES (?, ?, ?, ?)");
        $statement->execute([$nom, 1, $idProfessor, 1]);
        }
        
    }catch(PDOException $e){
        echo "Error crearActivitat: " . $e->getMessage();
    }

}

function obtenimGrups(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM grup");
        $statement->execute();
        return $statement;
    }catch(PDOException $e){
        echo "Error mostrarGrupos: " . $e->getMessage();
    }
}

function eliminarGrups(){
    try{
        $con = connect();
        // Primero, reasigna o elimina todos los alumnos que están en un grupo
        $statement = $con->prepare("UPDATE alumne SET grup_id = NULL WHERE grup_id IS NOT NULL");
        $statement->execute();
        // Luego, reasigna o elimina todos los profesores que están en un grupo
        $statement = $con->prepare("UPDATE professor SET grup_id = NULL WHERE grup_id IS NOT NULL");
        $statement->execute();
        // Luego, reasigna o elimina todos los administradores que están en un grupo
        $statement = $con->prepare("UPDATE admin SET grup_id = NULL WHERE grup_id IS NOT NULL");
        $statement->execute();
        // Luego, reasigna o elimina todas las actividades que están en un grupo
        $statement = $con->prepare("UPDATE activitat SET grup1 = NULL, grup2 = NULL WHERE grup1 IS NOT NULL OR grup2 IS NOT NULL");
        $statement->execute();
        // Finalmente, elimina los grupos
        $statement = $con->prepare("DELETE FROM grup");
        $statement->execute();
    }catch(PDOException $e){
        echo "Error eliminarGrups: " . $e->getMessage();
    }
}

function guardarGrupo($grupo) {
    $idProfessor = obtenerIdProfessor();
    $grupos = obtenirGrups()->fetchAll();
    $id = 1;
    if(empty($grupos)){
    }else{
        foreach ($grupos as $gr) {
            if ($gr['grup_id'] === $id) {
                $id++;
            } else if ($gr['grup_id'] != $id) {
                break;
            }
        }
    }
    crearGrup($id, 'Grup-'. $id, '', 0, $idProfessor);
}

function assignarGrups($alumnes){
    try{
    $con = connect();
    $professors = obtenirProfessors()->fetchAll();
    $idProfessor = obtenerIdProfessor();
    $activitats = obtenirActivitats()->fetchAll();
    $grups = obtenimGrups()->fetchAll();
    if(count($grups)%2 != 0){
        ?><script>alert("S'ha creat un grup extra sense ningu ja que son imparells, si ho veus oportu pots eliminar-ho")</script><?php
        $idProfessor = obtenerIdProfessor();
        $grupos = obtenirGrups()->fetchAll();
        $id = 1;
        if(empty($grupos)){
        }else{
            foreach ($grupos as $gr) {
                if ($gr['grup_id'] === $id) {
                    $id++;
                } else if ($gr['grup_id'] != $id) {
                    break;
                }
            }
        }
        crearGrup($id, 'Grup-'. $id, '', 0, $idProfessor);
    }
    $grups = obtenimGrups()->fetchAll();
    foreach ($grups as $grup) {
        if(empty($professors)){
            $professors = obtenirProfessors()->fetchAll();
        }
        $posicio = rand(0, count($professors) - 1);
        $id_professor_encarregat = $professors[$posicio]['professor_id'];
        $statement = $con->prepare("UPDATE grup SET id_professor_encarregat = ? WHERE grup_id = ?");
        $statement->execute([$id_professor_encarregat, $grup['grup_id']]);
        array_splice($professors, $posicio, 1);
    }
    $diferencia = count($grups)/2 > count($activitats);
    if($diferencia){
        ?><script>alert("Hi ha més grups que activitats , es crearan les activitats que faltan, les has d'omplir")</script><?php
        for($i = count($activitats); $i < count($grups)/2; $i++){
            $nom = 'Activitat ' . ($i + 1);
            crearActivitat($nom, $idProfessor, $diferencia);
        }
    }
    $activitats = obtenirActivitats()->fetchAll();
    foreach ($activitats as $activitat) {
        $posicio = rand(0, count($grups) - 1);
        $id_grup1 = $grups[$posicio]['grup_id'];
        array_splice($grups, $posicio, 1);
        $id_grup2 = $grups[$posicio]['grup_id'];
        while($id_grup1 == $id_grup2){
            $posicio = rand(0, count($grups) - 1);
            $id_grup2 = $grups[$posicio]['grup_id'];
        }        
        array_splice($grups, $posicio, 1);
        $statement = $con->prepare("UPDATE activitat SET grup1 = ?, grup2 = ? WHERE actividad_id = ?");
        $statement->execute([$id_grup1, $id_grup2, $activitat['actividad_id']]);
    }

    $alumnes = obtenirAlumnes()->fetchAll();

    // $DAW2 = [];
    // $DAW1 = [];
    // $ASIX1 = [];
    // $ASIX2 = []; 
    // $SMX1A = [];
    // $SMX1B = [];
    // $SMX1C = [];
    // $SMX2A = [];
    // $SMX2B = [];
    // $SMX2C = [];
    // foreach ($alumnes as $alumne) {
    //     if($alumne['classe'] == "A" && $alumne['curs'] == "DAW" && $alumne['any'] == '2n'){
    //         $DAW2[] = $alumne;
    //     }else if($alumne['classe'] == "A" && $alumne['curs'] == "DAW" && $alumne['any'] == '1r'){
    //         $DAW1[] = $alumne;
    //     }else if($alumne['classe'] == "A" && $alumne['curs'] == "ASIX" && $alumne['any'] == '1r'){
    //         $ASIX1[] = $alumne;
    //     }else if($alumne['classe'] == "A" && $alumne['curs'] == "ASIX" && $alumne['any'] == '2n'){
    //         $ASIX2[] = $alumne;
    //     }
    //     if($alumne['classe'] == "A" && $alumne['curs'] == "SMX" && $alumne['any'] == '1r'){
    //         $SMX1A[] = $alumne;
    //     }
    //     if($alumne['classe'] == "B" && $alumne['curs'] == "SMX" && $alumne['any'] == '1r'){
    //         $SMX1B[] = $alumne;
    //     }
    //     if($alumne['classe'] == "C" && $alumne['curs'] == "SMX" && $alumne['any'] == '1r'){
    //         $SMX1C[] = $alumne;
    //     }
    //     if($alumne['classe'] == "A" && $alumne['curs'] == "SMX" && $alumne['any'] == '2n'){
    //         $SMX2A[] = $alumne;
    //     }
    //     if($alumne['classe'] == "B" && $alumne['curs'] == "SMX" && $alumne['any'] == '2n'){
    //         $SMX2B[] = $alumne;
    //     }
    //     if($alumne['classe'] == "C" && $alumne['curs'] == "SMX" && $alumne['any'] == '2n'){
    //         $SMX2C[] = $alumne;
    //     }
    // }

    }catch(PDOException $e){
        echo "Error assignarAlumne: " . $e->getMessage();
    }
}
?>