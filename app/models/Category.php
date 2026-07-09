<?php
// MODELO DE CATEGORÍAS
// Gestiona todas las operaciones CRUD sobre la tabla 'categorias'.

class Category {
    private static $table_name = "categorias";

    // Obtiene todas las categorías ordenadas alfabéticamente por nombre.
    public static function readAll() {
        $conn = Conexion::getConnection();
        $query = "SELECT * FROM " . self::$table_name . " ORDER BY nombre ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crea una nueva categoría con los datos proporcionados.
    // Sanitiza nombre y descripción antes de insertar.
    public static function create($nombre, $descripcion) {
        $conn = Conexion::getConnection();
        $query = "INSERT INTO " . self::$table_name . " SET nombre=:nombre, descripcion=:descripcion";
        $stmt = $conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $descripcion = htmlspecialchars(strip_tags($descripcion));

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);

        return $stmt->execute();
    }

    // Devuelve los datos de una categoría específica por su ID.
    public static function readOne($id) {
        $conn = Conexion::getConnection();
        $query = "SELECT * FROM " . self::$table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualiza el nombre y descripción de una categoría existente.
    public static function update($id, $nombre, $descripcion) {
        $conn = Conexion::getConnection();
        $query = "UPDATE " . self::$table_name . " SET nombre=:nombre, descripcion=:descripcion WHERE id=:id";
        $stmt = $conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $nombre = htmlspecialchars(strip_tags($nombre));
        $descripcion = htmlspecialchars(strip_tags($descripcion));

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);

        return $stmt->execute();
    }

    // Elimina una categoría de la base de datos por su ID.
    public static function delete($id) {
        $conn = Conexion::getConnection();
        $query = "DELETE FROM " . self::$table_name . " WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
