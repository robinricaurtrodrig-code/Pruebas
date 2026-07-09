<?php
// ARCHIVO PRINCIPAL - FRONT CONTROLLER
// Punto de entrada único del sistema. Interpreta la URL y ejecuta la acción solicitada.

require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/CategoryController.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/OrderController.php';

// Captura los parámetros de la URL. Por defecto lista productos.
$controlador = isset($_GET['controlador']) ? $_GET['controlador'] : 'productos';
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Enrutador: según el controlador y acción, ejecuta el método estático correspondiente.
if ($controlador == 'productos') {
    switch ($accion) {
        case 'listar': ProductController::index(); break;
        case 'nuevo': ProductController::create(); break;
        case 'guardar': ProductController::store(); break;
        case 'editar': ProductController::edit($id); break;
        case 'actualizar': ProductController::update(); break;
        case 'eliminar': ProductController::delete($id); break;
        default: ProductController::index(); break;
    }
}
elseif ($controlador == 'categorias') {
    switch ($accion) {
        case 'listar': CategoryController::index(); break;
        case 'guardar': CategoryController::store(); break;
        case 'eliminar': CategoryController::delete($id); break;
        default: CategoryController::index(); break;
    }
}
elseif ($controlador == 'usuarios') {
    switch ($accion) {
        case 'listar': UserController::index(); break;
        case 'guardar': UserController::store(); break;
        case 'eliminar': UserController::delete($id); break;
        default: UserController::index(); break;
    }
}
elseif ($controlador == 'pedidos') {
    switch ($accion) {
        case 'listar': OrderController::index(); break;
        case 'guardar': OrderController::store(); break;
        default: OrderController::index(); break;
    }
}
else {
    // Si el controlador no existe, redirige a productos por defecto.
    ProductController::index();
}
