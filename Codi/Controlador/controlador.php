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
    ?>
<script>
        location.replace("../Vista/index_admin.php");
</script>
<?php
}else if(isAlumne($email)){?>
<script>
        location.replace("../Vista/index_alumne.php");
</script>
<?php
}else if(isProfessor($email)){?>
<script>
        location.replace("../Vista/index_professor.php");
</script>
<?php
}else {?>
<script>
    location.replace("../index.php");
</script>
<?php
    
}?>