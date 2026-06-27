<?php
class Conexion {

    public static function getConnection() {

    $host = "localhost:3307";
    $db_name = "registro_mvc";
    $username = "root";
    $password = "";

        $conn = null;
        $conn = new mysqli($host, $username, $password, $db_name);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        return $conn;
    }
}
