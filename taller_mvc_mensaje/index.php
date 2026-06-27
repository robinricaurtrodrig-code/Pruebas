<?php
require_once __DIR__ . '/controllers/ContactoController.php';

$action = $_GET['action'] ?? 'formulario';

switch ($action) {
    case 'guardar':
        ContactoController::procesarFormulario();
        break;

    case 'lista':
        $mensajes = ContactoController::listarMensajes();
        require_once __DIR__ . '/views/lista.php';
        break;

    case 'formulario':
    default:
        require_once __DIR__ . '/views/formulario.php';
        break;
}