<?php
function conectarBBDD($host, $nombreBD, $bd = "mysql", $charset = "utf8mb4", $usuario = "root", $password = "") {
    try {
        $dsn = "$bd:host=$host;dbname=$nombreBD;charset=$charset";
        $conexion = new PDO($dsn, $usuario, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}
?>
