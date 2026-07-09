<?php
// MODELO DE PRODUCTOS
// Gestiona todas las operaciones CRUD sobre la tabla 'productos' con relación a categorías.

class Product {
    private static $table_name = "productos";

    // Obtiene todos los productos con el nombre de su categoría asociada.
    // Realiza un JOIN con la tabla 'categorias' y ordena por fecha de creación descendente.
    public static function readAll() {
        $conn = Conexion::getConnection();
        $query = "SELECT p.*, c.nombre as categoria_nombre 
                  FROM " . self::$table_name . " p 
                  INNER JOIN categorias c ON p.categoria_id = c.id 
                  ORDER BY p.created_at DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Inserta un nuevo producto en la base de datos con todos sus datos sanitizados.
    public static function create($categoria_id, $nombre, $precio, $descripcion, $disponible) {
        $conn = Conexion::getConnection();
        $query = "INSERT INTO " . self::$table_name . " 
                  SET categoria_id=:categoria_id, nombre=:nombre, precio=:precio, descripcion=:descripcion, disponible=:disponible";

        $stmt = $conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $descripcion = htmlspecialchars(strip_tags($descripcion));
        $precio = htmlspecialchars(strip_tags($precio));
        $categoria_id = htmlspecialchars(strip_tags($categoria_id));
        $disponible = htmlspecialchars(strip_tags($disponible));

        $stmt->bindParam(":categoria_id", $categoria_id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":disponible", $disponible);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Elimina un producto de la base de datos por su ID.
    public static function delete($id) {
        $conn = Conexion::getConnection();
        $query = "DELETE FROM " . self::$table_name . " WHERE id = :id";
        $stmt = $conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtiene los datos de un producto específico por su ID.
    public static function readOne($id) {
        $conn = Conexion::getConnection();
        $query = "SELECT * FROM " . self::$table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualiza los datos completos de un producto existente.
    public static function update($id, $categoria_id, $nombre, $precio, $descripcion, $disponible) {
        $conn = Conexion::getConnection();
        $query = "UPDATE " . self::$table_name . " 
                  SET categoria_id = :categoria_id, nombre = :nombre, precio = :precio, descripcion = :descripcion, disponible = :disponible 
                  WHERE id = :id";

        $stmt = $conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $descripcion = htmlspecialchars(strip_tags($descripcion));
        $precio = htmlspecialchars(strip_tags($precio));
        $categoria_id = htmlspecialchars(strip_tags($categoria_id));
        $disponible = htmlspecialchars(strip_tags($disponible));
        $id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(":categoria_id", $categoria_id);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":disponible", $disponible);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
