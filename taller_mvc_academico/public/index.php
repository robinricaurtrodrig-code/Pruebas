<?php
$ruta = $_GET['r'] ?? 'asignaturas';

if ($ruta === 'asignaturas') {
    require_once __DIR__ . '/../app/controllers/AsignaturaController.php';
    $controller = new AsignaturaController();
    $controller->index();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página no encontrada";
}
