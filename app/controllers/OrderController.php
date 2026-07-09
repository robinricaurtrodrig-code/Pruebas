<?php
// CONTROLADOR DE PEDIDOS
// Coordina las acciones entre los modelos Order, Product, User y la vista de pedidos.

require_once '../app/config/Database.php';
require_once '../app/models/Order.php';
require_once '../app/models/Product.php';
require_once '../app/models/User.php';

class OrderController {

    // Muestra el historial de pedidos con productos y usuarios.
    // También carga los selectores para registrar una nueva venta.
    public static function index() {
        $stmt = Order::readAll();
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productos = Product::readAll()->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = User::readAll()->fetchAll(PDO::FETCH_ASSOC);

        require_once '../app/views/orders/index.php';
    }

    // Procesa el registro de una nueva venta.
    // Obtiene el precio del producto, calcula el total en backend y guarda el pedido.
    public static function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : '';
            $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';
            $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

            if (empty($producto_id) || empty($usuario_id) || $cantidad <= 0) {
                die("Error: Datos de pedido inválidos.");
            }

            $item = Product::readOne($producto_id);

            if (!$item) {
                die("Error: El producto seleccionado no existe.");
            }

            $precio_unitario = floatval($item['precio']);
            $total_calculado = $precio_unitario * $cantidad;

            if (Order::create($producto_id, $usuario_id, $cantidad, $total_calculado)) {
                header("Location: index.php?controlador=pedidos&accion=listar");
                exit();
            }
        }
    }
}
