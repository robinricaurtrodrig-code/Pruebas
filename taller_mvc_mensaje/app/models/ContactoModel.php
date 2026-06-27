<?php
require_once __DIR__ . '/../config/database.php';

class ContactoModel {

//guardar un mensaje en la base de datos
public static function guardarMsj($nombre, $correo, $asunto, $mensaje)
{

$conn = Database::getConnection();
$stmt = $conn->prepare("INSERT INTO mensajes (nombre, correo, asunto, mensaje) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $correo, $asunto, $mensaje);

return $stmt->execute();
}

 // Obtener todos los mensajes
  public static function obtenerTodos() {
    $conn = Database::getConnection();
    $resultado = $conn->query("SELECT * FROM mensajes ORDER BY fecha DESC");
    $mensajes = [];
    while ($fila = $resultado->fetch_assoc()) {
        $mensajes[] = $fila;
    }
    return $mensajes;

}
}