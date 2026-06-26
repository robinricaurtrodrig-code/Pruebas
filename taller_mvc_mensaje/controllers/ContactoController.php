<?php
require_once __DIR__ . "/../models/ContactoModel.php";

class ContactoController 
{
//procesar el formulario cuando se envia por POST
public static function procesarFormulario()
{
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    //llamar al modelo para guardar el mensaje
    ContactoModel::guardarMsj($nombre, $correo, $asunto, $mensaje);

    //redirige para evitar reenvio del formulario
    header("Location: index.php?action=lista");
    exit();
}
}
 // Obtener todos los mensajes (lo usará la vista lista)
    public static function listarMensajes() {
        return ContactoModel::obtenerTodos();

}
}