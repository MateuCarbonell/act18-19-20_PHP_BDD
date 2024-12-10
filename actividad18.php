<?php
// Incluir la conexión y funciones
require_once 'connection.php';  
require_once 'funciones.php';    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Conectar a la base de datos
    $pdo = conectarBBDD("127.0.0.1", "DWES");

    if ($pdo) {
        $user = getUserByName($pdo, $username);

        if ($user) {
            // Si se encuentra el usuario, mostrar la información
            echo "<h3>Usuario encontrado:</h3>";
            echo "<p><strong>Nombre:</strong> " . htmlspecialchars($user['nombre']) . "</p>";
            echo "<p><strong>Apellido:</strong> " . htmlspecialchars($user['apellido']) . "</p>";
            echo "<p><strong>Username:</strong> " . htmlspecialchars($user['username']) . "</p>";
            echo "<p><strong>Estado:</strong> " . ($user['estado'] == 1 ? "Activo" : "Inactivo") . "</p>";
        } else {
            echo "<p>No se encontró un usuario con el nombre '$username'.</p>";
        }
    } else {
        echo "No se pudo conectar a la base de datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Usuario</title>
</head>
<body>
    <h2>Buscar Usuario</h2>
    <form action="actividad18.php" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br><br>
        <input type="submit" value="Buscar Usuario">
    </form>
</body>
</html>
