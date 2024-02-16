<?php
session_start();
if(!isset($_SESSION['email'])){
    require_once "../autentificacion.php";
    $_SESSION['email'] = $email;
}
$email = $_SESSION['email'];
require_once '../../Recursos/configuracio.php';
require_once '../Model/model.php';
if(isAdmin($email)){
    include '../Vista/index_admin.php';
}else if(isAlumne($email)){
   include_once '../Vista/index_alumne.php';
}else if(isProfessor($email)){
    include_once '../Vista/index_professor.php';
}else {?>
<script>
    location.replace("../index.php");
</script>
<?php
    
}?>