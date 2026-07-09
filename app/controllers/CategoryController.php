<?php
// CONTROLADOR DE CATEGORÍAS
// Coordina las acciones entre el modelo Category y las vistas de categorías.

require_once '../app/config/Conexion.php';
require_once '../app/models/Category.php';

class CategoryController {

    // Lista todas las categorías y carga la vista correspondiente.
    public static function index() {
        $stmt = Category::readAll();
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once '../app/views/categories/index.php';
    }

    // Procesa el formulario de creación de una nueva categoría.
    // Valida los datos en backend antes de guardar.
    public static function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

            if (empty($nombre) || strlen($nombre) < 3) {
                die("Error: El nombre de la categoría debe tener al menos 3 caracteres.");
            }

            if (Category::create($nombre, $descripcion)) {
                header("Location: index.php?controlador=categorias&accion=listar");
                exit();
            }
        }
    }

    // Procesa la actualización de una categoría existente.
    public static function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? trim($_POST['id']) : '';
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';

            if (empty($id) || empty($nombre) || strlen($nombre) < 3) {
                die("Error: Datos inválidos para actualizar categoría.");
            }

            if (Category::update($id, $nombre, $descripcion)) {
                header("Location: index.php?controlador=categorias&accion=listar");
                exit();
            }
        }
    }

    // Elimina una categoría por su ID tras validar que sea numérico.
    public static function delete($id) {
        if (!empty($id) && is_numeric($id)) {
            if (Category::delete($id)) {
                header("Location: index.php?controlador=categorias&accion=listar");
                exit();
            }
        }
    }
}
