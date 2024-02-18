<?php
session_start();
require_once '../Controlador/controlador_alumne.php';

// Esta parte se ejecutará cuando el usuario confirme o niegue la asistencia
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmacion'])) {
    $confirmacion = ($_POST['confirmacion'] == 1) ? 1 : 0;

    // Obtener el email del usuario desde la sesión
    $email = $_SESSION['email'];

    // Utilizar la función del modelo para actualizar la asistencia
    actualizarAsistencia($email, $confirmacion);

    // Establecer una cookie para evitar mostrar el modal nuevamente
    setcookie('asistencia_confirmada', 'true', time() + 3600 * 24 * 30); // Expira en 30 días
}
?>
