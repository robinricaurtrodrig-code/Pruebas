<?php
// CONTROLADOR DE USUARIOS
// Coordina las acciones entre el modelo User y las vistas de gestión de personal.

require_once '../app/config/Conexion.php';
require_once '../app/models/User.php';

class UserController {

    // Lista todos los usuarios registrados y carga la vista correspondiente.
    public static function index() {
        $stmt = User::readAll();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once '../app/views/users/index.php';
    }

    // Procesa el registro de un nuevo usuario.
    // Valida nombre, correo y contraseña antes de guardar en la base de datos.
    public static function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $rol = isset($_POST['rol']) ? trim($_POST['rol']) : 'empleado';

            if (empty($nombre) || strlen($nombre) < 3 || empty($correo) || empty($password)) {
                die("Error: Todos los campos son obligatorios y el nombre debe tener al menos 3 letras.");
            }

            if (User::create($nombre, $correo, $password, $rol)) {
                header("Location: index.php?controlador=usuarios&accion=listar");
                exit();
            } else {
                echo "No se pudo registrar el usuario.";
            }
        }
    }

    // Elimina un usuario por su ID tras validar que sea numérico.
    public static function delete($id) {
        if (!empty($id) && is_numeric($id)) {
            if (User::delete($id)) {
                header("Location: index.php?controlador=usuarios&accion=listar");
                exit();
            }
        }
    }
}
