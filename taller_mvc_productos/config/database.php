<?php  // conexion a la base de datos

class Database {
    private static $host = '127.0.0.1';
    private static $port = '3307';
    private static $dbname = 'tienda_mvc';
    private static $user = 'root';
    private static $password = '';
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8mb4",
                    self::$user,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Error de conexion: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
