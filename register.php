<?php
session_start();
require_once 'connection.php'; 
require_once 'funciones.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (registrarUsuario($nombre, $apellido, $username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: intranet.php");
        exit();
    } else {
        echo "Error al registrar al usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Nuevo Usuario</h2>
    <form action="register.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellidos:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
