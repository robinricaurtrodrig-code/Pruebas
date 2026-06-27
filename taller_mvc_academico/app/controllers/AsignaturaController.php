<?php
require_once __DIR__ . '/../models/Asignatura.php';

class AsignaturaController {

    public function index() {
        $busqueda = $_GET['buscar'] ?? '';
        $mostrar = $_GET['mostrar'] ?? '';

        if (!empty($busqueda)) {
            $asignaturas = Asignatura::buscarPorNombre($busqueda);
        } elseif ($mostrar === 'todas') {
            $asignaturas = Asignatura::listarTodas();
        } else {
            $asignaturas = [];
        }

        require_once __DIR__ . '/../views/asignaturas/index.php';
    }
}
