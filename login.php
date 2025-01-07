<?php
session_start();
require_once 'connection.php';
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Conectar a la base de datos
    $pdo = conectarBBDD("127.0.0.1", "DWES");

    if ($pdo) {
        // Obtener el usuario por el nombre
        $user = getUserByName($pdo, $username);

        if ($user) {

            // Comprobar contraseña y estado
            if ($user['estado'] == 1 && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                header("Location: intranet.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error al conectar con la base de datos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Usuario</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </form>
                        <div class="text-center">
                            <a href="register.php" class="btn btn-link">¿No tienes cuenta? Regístrate aquí</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
