<?php
require_once 'connection.php';

function registrarUsuario($nombre, $apellido, $username, $password) {
    $pdo = conectarBBDD("127.0.0.1", "DWES");
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO Usuarios (nombre, apellido, username, password, estado) 
            VALUES (:nombre, :apellido, :username, :password, 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $passwordHash);
    return $stmt->execute();
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
