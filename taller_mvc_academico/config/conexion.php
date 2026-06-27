<?php
class Conexion {

    public static function conectar() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "academico_mvc";
    $conn = null;

        $conn = new mysqli($host, $user, $pass, $db, 3307);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }
}
