<?php
require_once __DIR__ . '/../../config/conexion.php';

class Asignatura {

//enlistar todas las asignaturas
    public static function listarTodas() {
        $conn = Conexion::conectar();
        $sql = "SELECT id, nombre_asignatura, nivel, docente, horas FROM asignaturas ORDER BY id";
        $resultado = $conn->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    //buscar por nombre
     public static function buscarPorNombre($nombre) {
        $conn = Conexion::conectar();

        $sql = "SELECT id, nombre_asignatura, nivel, docente, horas FROM asignaturas 
                 WHERE nombre_asignatura LIKE ?
                ORDER BY id";
                
        $stmt = $conn->prepare($sql);
        $param = "%{$nombre}%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}