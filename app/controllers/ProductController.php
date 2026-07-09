<?php
// CONTROLADOR DE PRODUCTOS
// Coordina todas las acciones CRUD entre el modelo Product y las vistas de productos.

require_once '../app/config/Database.php';
require_once '../app/models/Product.php';

class ProductController {

    // Lista todos los productos con su categoría y carga la vista principal.
    public static function index() {
        $stmt = Product::readAll();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once '../app/views/products/index.php';
    }

    // Carga el formulario para agregar un nuevo producto.
    public static function create() {
        require_once '../app/views/products/create.php';
    }

    // Procesa el formulario de creación.
    // Valida los datos en backend (nombre, categoría, precio) y guarda el producto.
    public static function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : '';
            $precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

            if (empty($nombre) || strlen($nombre) < 3 || empty($categoria_id) || empty($precio) || !is_numeric($precio) || $precio <= 0) {
                die("Error de validación en el servidor: Datos inválidos o vacíos.");
            }

            if (Product::create($categoria_id, $nombre, $precio, $descripcion, 1)) {
                header("Location: index.php?accion=listar");
                exit();
            } else {
                echo "No se pudo registrar el producto debido a un problema interno.";
            }
        }
    }

    // Elimina un producto por su ID tras validar que sea numérico.
    public static function delete($id) {
        if (!empty($id) && is_numeric($id)) {
            if (Product::delete($id)) {
                header("Location: index.php?accion=listar");
                exit();
            } else {
                echo "No se pudo eliminar el producto.";
            }
        } else {
            die("ID de producto inválido.");
        }
    }

    // Carga el formulario de edición con los datos actuales del producto.
    public static function edit($id) {
        if (!empty($id) && is_numeric($id)) {
            $producto = Product::readOne($id);
            if ($producto) {
                require_once '../app/views/products/edit.php';
            } else {
                echo "Producto no encontrado.";
            }
        }
    }

    // Procesa la actualización de un producto existente con validación backend.
    public static function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? trim($_POST['id']) : '';
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : '';
            $precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
            $disponible = isset($_POST['disponible']) ? trim($_POST['disponible']) : '';

            if (empty($id) || empty($nombre) || strlen($nombre) < 3 || empty($precio) || $precio <= 0) {
                die("Error de validación en el servidor: Los datos editados son inválidos.");
            }

            if (Product::update($id, $categoria_id, $nombre, $precio, $descripcion, $disponible)) {
                header("Location: index.php?accion=listar");
                exit();
            } else {
                echo "No se pudieron guardar los cambios.";
            }
        }
    }
}
