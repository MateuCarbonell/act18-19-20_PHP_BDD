<?php
require_once 'connection.php';

function registrarUsuario($nombre, $apellido, $username, $password) {
    // Conectar a la base de datos
    $pdo = conectarBBDD("127.0.0.1", "DWES");

    // Verificar si el nombre de usuario ya existe
    $sqlCheck = "SELECT COUNT(*) FROM Usuarios WHERE username = :username";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':username', $username);
    $stmtCheck->execute();
    $existe = $stmtCheck->fetchColumn(); // Devuelve el número de coincidencias

    if ($existe > 0) {
        // El nombre de usuario ya está registrado
        return false;
    }

    // Si no existe, continuar con el registro
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO Usuarios (nombre, apellido, username, password, estado) 
            VALUES (:nombre, :apellido, :username, :password, 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $passwordHash);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}



function getUserByName($pdo, $username) {
    // PDO recibido como parámetro
    $sql = "SELECT * FROM Usuarios WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

function darDeBajaUsuario($username) {
    $pdo = conectarBBDD("127.0.0.1", "DWES");
    $sql = "UPDATE Usuarios SET estado = 0 WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    return $stmt->execute();
}
?>
