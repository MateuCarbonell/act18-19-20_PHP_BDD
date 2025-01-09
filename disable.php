<?php
session_start();
require_once 'funciones.php';

$username = $_SESSION['username'];

if (darDeBajaUsuario($username)) {
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    echo "Error al darse de baja.";
}
?>
