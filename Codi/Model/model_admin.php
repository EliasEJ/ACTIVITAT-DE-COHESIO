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

function obtenerGruposDisponibles(){

    try{
        $con = connect();
        $statement = $con->prepare("SELECT g.*
        FROM grup g
        LEFT JOIN activitat a ON g.grup_id = a.grup1 OR g.grup_id = a.grup2
        WHERE a.actividad_id IS NULL");
        $statement->execute();
        return $statement;
    }catch (PDOException $e){
        echo "Error obtenerGruposDisponibles: " . $e->getMessage();
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
        $statement = $con->prepare("INSERT INTO activitat (actividad_id,nom, posicion_id, professor_id, material_id) VALUES (?, ?, ?, ?)");
        $statement->execute([$nom, 1, $idProfessor, 1]);
        }else{
        $statement = $con->prepare("UPDATE activitat (actividad_id,nom, posicion_id, professor_id, material_id) VALUES (?, ?, ?, ?)");
        $statement->execute([$nom, 1, $idProfessor, 1]);
        }
        
    }catch(PDOException $e){
        echo "Error crearActivitat: " . $e->getMessage();
    }

}

function aplicarActividadProfesor($idProf, $idAct){
    try{
        $con = connect();
        $statement = $con->prepare("UPDATE professor SET actividad_id = :actividad_id WHERE professor_id = :id_profesor");
        $statement->execute(
            array(
                ':actividad_id' => $idProf,
                ':id_profesor' => $idAct
            )
        );
        
    }catch(PDOException $e){
        echo "Error mostrarGrupos: " . $e->getMessage();
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
        if (empty($grups)) {
        } else {
            // Si $grups no está vacío, obtén un nuevo índice aleatorio
            $id_grup1 = $grups[$posicio]['grup_id'];
            array_splice($grups, $posicio, 1);
            $posicio = rand(0, count($grups) - 1);
            $id_grup2 = $grups[$posicio]['grup_id'];
            while($id_grup1 == $id_grup2){
                if(count($grups)){
                    $id_grup2 = $grups[1]['grup_id'];
                    return;
                }
                $posicio = rand(0, count($grups) - 1);
                $id_grup2 = $grups[$posicio]['grup_id'];
            }        
            array_splice($grups, $posicio, 1);
            $statement = $con->prepare("UPDATE activitat SET grup1 = ?, grup2 = ? WHERE actividad_id = ?");
            $statement->execute([$id_grup1, $id_grup2, $activitat['actividad_id']]);
        }
    }

    $alumnes = obtenirAlumnes()->fetchAll();
    usort($alumnes, function($a, $b) {
        if ($a['curs'].$a['classe'].$a['any'] == $b['curs'].$b['classe'].$b['any']) {
            return 0;
        }
        return ($a['curs'].$a['classe'].$a['any'] > $b['curs'].$b['classe'].$b['any']) ? 1 : -1;
    });
    $groups = [];
    foreach ($alumnes as $alumne) {
        $key = $alumne['curs'] . $alumne['any'] . $alumne['classe'];
        $groups[$key][] = $alumne;
    }
    $firstGroup = reset($groups);
    $firstAlumne = reset($firstGroup);
    $cursoActual = $firstAlumne['curs'];
    $claseActual = $firstAlumne['classe'];
    $anyActual = $firstAlumne['any'];
    $posicio = 0;
    $contador = 0;
    foreach ($groups as $group) {
        $grups = obtenimGrups()->fetchAll();
        $id_grup = $grups[$posicio]['grup_id'];
        foreach ($group as $alumne) {
            if((($alumne['curs'] == $cursoActual || $alumne['classe'] == $claseActual || $alumne['any'] == $anyActual) || !($contador > 20))){
                $statement = $con->prepare("UPDATE alumne SET grup_id = ? WHERE alumne_id = ?");
                $statement->execute([$id_grup, $alumne['alumne_id']]);
                $contador++;
                $cursoActual = $alumne['curs'];
                $claseActual = $alumne['classe'];
                $anyActual = $alumne['any'];
            }
            else{
                $cursoActual = $alumne['curs'];
                $claseActual = $alumne['classe'];
                $anyActual = $alumne['any'];
                break;
            }
            array_splice($grups, $posicio, 1);
        }
        $posicio++;
    }
    
    }catch(PDOException $e){
        echo "Error assignarAlumne: " . $e->getMessage();
    }
}

function acabat(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM accions WHERE final = 1");
        $statement->execute();
       if($statement){
            return true;
        }else{
            return false;
        }
    }catch(PDOException $e){
        echo "Error acabat: " . $e->getMessage();
    }
}

function començar(){
    try{
        $con = connect();
        $statement = $con->prepare("SELECT * FROM accions WHERE comencar = 1");
        $statement->execute();
        if($statement){
            return true;
        }else{
            return false;
        }         
    }catch(PDOException $e){
        echo "Error començar: " . $e->getMessage();
    }
}

function comencarJoc(){
    try{
        $con = connect();
        $statement = $con->prepare("UPDATE accions SET comencar = 1 WHERE id = 1");
        $statement->execute();
    }catch(PDOException $e){
        echo "Error començarJoc: " . $e->getMessage();
    }
}

function acabarJoc(){
    try{
        $con = connect();
        $statement = $con->prepare("UPDATE accions SET final = 1 WHERE id = 1");
        $statement->execute();
    }catch(PDOException $e){
        echo "Error acabarJoc: " . $e->getMessage();
    }
}
?>