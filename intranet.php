<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Intranet</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="logout.php">Cerrar sesión</a>
    <br>
    <a href="disable.php">Darse de baja</a>
    <form action="actividad18.php">
        
    </form>
</body>
</html>
