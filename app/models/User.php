<?php
// MODELO DE USUARIOS
// Gestiona las operaciones sobre la tabla 'usuarios' para el control de personal.

class User {
    private static $table_name = "usuarios";

    // Obtiene todos los usuarios registrados ordenados del más reciente al más antiguo.
    public static function readAll() {
        $conn = Conexion::getConnection();
        $query = "SELECT * FROM " . self::$table_name . " ORDER BY id DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Registra un nuevo usuario con nombre, correo, contraseña y rol.
    // Sanitiza todos los campos antes de insertar.
    public static function create($nombre, $correo, $password, $rol) {
        $conn = Conexion::getConnection();
        $query = "INSERT INTO " . self::$table_name . " SET nombre=:nombre, correo=:correo, password=:password, rol=:rol";
        $stmt = $conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $correo = htmlspecialchars(strip_tags($correo));
        $password = htmlspecialchars(strip_tags($password));
        $rol = htmlspecialchars(strip_tags($rol));

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":rol", $rol);

        return $stmt->execute();
    }

    // Elimina un usuario de la base de datos por su ID.
    public static function delete($id) {
        $conn = Conexion::getConnection();
        $query = "DELETE FROM " . self::$table_name . " WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
