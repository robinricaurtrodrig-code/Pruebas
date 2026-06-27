<?php
// ============================================
// PHP PRIMERO: procesamos ANTES de mostrar HTML
// ============================================

// Verificamos que los datos llegaron correctamente por POST
// $_SERVER['REQUEST_METHOD'] nos dice cómo llegó la petición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // isset() verifica que el campo exista
    // htmlspecialchars() convierte caracteres especiales para mostrarlos seguros
    // Ejemplo: si alguien escribe <script>, no se ejecutará
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $email  = isset($_POST['email'])  ? htmlspecialchars($_POST['email'])  : '';

} else {
    // Si alguien intenta entrar directo a esta URL sin pasar por el formulario
    // lo redirigimos de vuelta al formulario
    // header() debe llamarse ANTES de cualquier HTML, por eso PHP va primero
    header('Location: contacto.php');
    exit; // Detenemos la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos Recibidos - Institución Educativa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
        }

        /* ── ENCABEZADO ── */
        header {
            background: #1a237e;
            color: white;
            text-align: center;
            padding: 25px;
        }
        header h1 { font-size: 28px; }
        header p  { font-size: 14px; margin-top: 5px; opacity: 0.8; }

        /* ── NAVEGACIÓN ── */
        nav {
            background: #283593;
            text-align: center;
            padding: 12px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-size: 17px;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 5px;
        }
        nav a:hover { background: #1a237e; }

        /* ── CONTENIDO ── */
        .container {
            max-width: 550px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
        .container h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        /* Tarjeta con los datos recibidos */
        .tarjeta {
            background: #e3f2fd;
            border-left: 5px solid #1a237e;
            padding: 25px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .tarjeta p {
            font-size: 17px;
            margin: 10px 0;
            color: #333;
        }
        .tarjeta span {
            font-weight: bold;
            color: #1a237e;
        }

        /* Nota explicativa */
        .nota-post {
            background: #f3e5f5;
            border-left: 4px solid #7b1fa2;
            padding: 12px 16px;
            border-radius: 5px;
            font-size: 13px;
            color: #555;
            margin-bottom: 20px;
        }

        /* Botones de acción */
        .acciones {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        .btn {
            flex: 1;
            text-align: center;
            padding: 11px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }
        .btn-volver   { background: #1a237e; color: white; }
        .btn-inicio   { background: #f0f4f8; color: #1a237e; border: 2px solid #1a237e; }
        .btn:hover    { opacity: 0.85; }
    </style>
</head>
<body>

    <header>
        <h1>🏫 Institución Educativa</h1>
        <p>Bienvenido a nuestro portal educativo</p>
    </header>

    <nav>
        <a href="index.php?seccion=inicio">🏠 Inicio</a>
        <a href="index.php?seccion=unidades">📚 Unidades</a>
        <a href="contacto.php">📧 Contacto</a>
    </nav>

    <div class="container">

        <h2>✅ ¡Datos recibidos correctamente!</h2>

        <p style="color:#555; margin-bottom:5px;">
            El servidor procesó los siguientes datos:
        </p>

        <!-- Mostramos los datos recibidos por POST -->
        <div class="tarjeta">
            <p>👤 <span>Nombre:</span> <?php echo $nombre; ?></p>
            <p>📧 <span>Correo:</span> <?php echo $email; ?></p>
        </div>

        <!-- Botones para seguir navegando -->
        <div class="acciones">
            <a href="contacto.php" class="btn btn-volver"><- Volver al formulario</a>
            <a href="index.php?seccion=inicio" class="btn btn-inicio">🏠 Ir al inicio</a>
        </div>

    </div>

</body>
</html>