<?php
// CLASE DE CONEXIÓN A LA BASE DE DATOS
// Proporciona una conexión PDO única y centralizada para todo el sistema.

class Conexion {

    // Obtiene y devuelve una conexión activa a la base de datos MySQL mediante PDO.
    // Configura el manejo de errores en modo excepción para facilitar la depuración.
    public static function getConnection() {
        // DB_HOST: servidor y puerto de MySQL 
        $host = getenv("DB_HOST") ?: "localhost:3307";
        // DB_NAME: nombre de la base de datos 
        $db_name = getenv("DB_NAME") ?: "burger_tech_db";
        // DB_USER: usuario de MySQL 
        $username = getenv("DB_USER") ?: "root";
        // DB_PASSWORD: contraseña del usuario 
        $password = getenv("DB_PASSWORD") ?: "";

        try {
            $conn = new PDO(
                "mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $exception) {
            die("Error de conexión: " . $exception->getMessage());
        }
    }
}
