<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $categoria = trim($_POST['categoria'] ?? '');
            $precio = floatval($_POST['precio'] ?? 0);
            $stock = intval($_POST['stock'] ?? 0);

            if ($nombre === '' || $categoria === '' || $precio <= 0 || $stock < 0) {
                $error = "Todos los campos son obligatorios y deben tener valores validos.";
                include __DIR__ . '/../views/producto/formulario.php';
                return;
            }

            $modelo = new Producto();
            $modelo->guardar($nombre, $categoria, $precio, $stock);

            header('Location: index.php?action=listar');
            exit;
        }

        include __DIR__ . '/../views/producto/formulario.php';
    }

    public function listar() {
        $modelo = new Producto();
        $productos = $modelo->obtenerTodos();
        include __DIR__ . '/../views/producto/listado.php';
    }
}
