<?php
// MODELO DE PEDIDOS
// Gestiona las operaciones sobre la tabla 'pedidos' con relaciones a productos y usuarios.

class Order {
    private static $table_name = "pedidos";

    // Obtiene todos los pedidos con el nombre del producto y del usuario que atendió.
    // Realiza un JOIN con las tablas 'productos' y 'usuarios' para mostrar datos completos.
    public static function readAll() {
        $conn = Database::getConnection();
        $query = "SELECT p.id, pr.nombre AS producto_name, u.nombre AS usuario_name, p.cantidad, p.total, p.fecha 
                  FROM " . self::$table_name . " p
                  INNER JOIN productos pr ON p.producto_id = pr.id
                  INNER JOIN usuarios u ON p.usuario_id = u.id
                  ORDER BY p.id DESC";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Registra un nuevo pedido calculado con producto, usuario, cantidad y total.
    public static function create($producto_id, $usuario_id, $cantidad, $total) {
        $conn = Database::getConnection();
        $query = "INSERT INTO " . self::$table_name . " SET producto_id=:producto_id, usuario_id=:usuario_id, cantidad=:cantidad, total=:total";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":producto_id", $producto_id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":total", $total);

        return $stmt->execute();
    }
}
