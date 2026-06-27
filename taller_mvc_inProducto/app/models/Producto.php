<?php

require_once __DIR__ . '/../config/database.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = Conexion::getConnection();
    }

    public function guardar($nombre, $categoria, $precio, $stock) {
        $sql = "INSERT INTO productos (nombre, categoria, precio, stock) VALUES (:nombre, :categoria, :precio, :stock)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':categoria' => $categoria,
            ':precio' => $precio,
            ':stock' => $stock
        ]);
        return $this->db->lastInsertId();
    }

    public function obtenerTodos() {
        $sql = "SELECT id, nombre, categoria, precio, stock, created_at FROM productos ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}