<?php

require_once __DIR__ . '/../controllers/ProductoController.php';

$action = $_GET['action'] ?? 'registrar';

$controller = new ProductoController();

switch ($action) {
    case 'registrar':
        $controller->registrar();
        break;
    case 'listar':
        $controller->listar();
        break;
    default:
        $controller->registrar();
        break;
}
