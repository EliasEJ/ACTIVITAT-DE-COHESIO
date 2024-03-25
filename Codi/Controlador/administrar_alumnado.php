<?php
require_once("../Vista/index_professor.php");
require_once("../Model/model_professor.php");
require_once("../Model/model.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['guardarAlumno'])) {
        $profeId =  $_SESSION['idProfe'];
        $alumnadoProfe = obtenirAlumnat($profeId)->fetchAll();

        $curso = $alumnadoProfe[0]['curs'];
        $año = $alumnadoProfe[0]['any'];
        $clase = $alumnadoProfe[0]['classe'];

        $alumnos = obtenerAlumnosTotal()->fetchAll();
        $newId = count($alumnos) + 1;
        $alumnName = $_POST['newAlumnNombre'];
        $alumnCognom = $_POST['newAlumnApellidos'];
        $alumnCorreu = $_POST['newAlumnCorreu'];
        $grupoId = $_POST['grup'];

        crearAlumno($newId, $alumnName, $alumnCognom, $alumnCorreu, $curso, $año, $clase, 1, 1, $grupoId, $profeId);

?>
        <script>
            alert("Alumne afegit correctament.")
        </script>
    <?php
    }  
    else if(isset($_POST['guardarAsistencia'])){
        foreach ($_POST['asistAl_id'] as $alumne_id) {
            // Obtener el nuevo identificador de grupo seleccionado para este alumno
            $confAsis = $_POST['asist'][$alumne_id];
            actualizarAsistencia($alumne_id, $confAsis);
            ?>
            <script>
                alert("Assistència dels alumnes canviats correctament.")
            </script>
        <?php
        }
    }


}
?>

<script>
    location.replace("../Vista/index_professor.php")
</script>