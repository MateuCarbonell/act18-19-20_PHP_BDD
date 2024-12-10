<?php
session_start();
require_once 'funciones.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
if (darDeBajaUsuario($username)) {
    session_destroy();  
    exit();
} else {
    echo "Error al darse de baja.";
}
?>
