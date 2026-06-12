<?php
// ============================================
// PHP SIEMPRE VA PRIMERO, ANTES DEL HTML
// ============================================
// Verificamos si llegó algún valor por GET
// Si no hay parámetro, usamos 'inicio' por defecto
$seccion = isset($_GET['seccion']) ? $_GET['seccion'] : 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Institución Educativa</title>
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
            transition: background 0.2s;
        }
        nav a:hover { background: #1a237e; }

        /* ── CONTENIDO PRINCIPAL ── */
        .container {
            max-width: 750px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }

        /* Mensaje verde que muestra la sección seleccionada */
        .message {
            background: #e8f5e9;
            border-left: 5px solid #43a047;
            padding: 14px 18px;
            border-radius: 5px;
            font-size: 17px;
            margin-bottom: 25px;
        }

        /* Caja de contenido de cada sección */
        .section-info {
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            padding: 25px;
            border-radius: 8px;
        }
        .section-info h2 { color: #1a237e; margin-bottom: 10px; }
        .section-info p  { color: #555; line-height: 1.6; }

        /* Botón para ir al formulario */
        .btn-contacto {
            display: inline-block;
            margin-top: 15px;
            background: #1a237e;
            color: white;
            padding: 10px 22px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-contacto:hover { background: #283593; }
    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <header>
        <h1>🏫 Institución Educativa</h1>
        <p>Bienvenido a nuestro portal educativo</p>
    </header>

    <!-- NAVEGACIÓN CON MÉTODO GET -->
    <!-- Cada enlace agrega ?seccion=valor a la URL -->
    <nav>
        <a href="index.php?seccion=inicio">🏠 Inicio</a>
        <a href="index.php?seccion=unidades">📚 Unidades</a>
        <a href="index.php?seccion=contacto">📧 Contacto</a>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container">

        <?php
    
        // PROCESAMIENTO DEL MÉTODO GET
        // En este punto $seccion ya tiene el valor
        // (lo definimos arriba al inicio del archivo)

        // Mostramos el mensaje con la sección activa
        echo '<div class="message">';
        echo '✅ <strong>Sección seleccionada:</strong> ' . htmlspecialchars($seccion);
        echo '</div>';

        // Mostramos el contenido según la sección elegida
        echo '<div class="section-info">';

        switch ($seccion) {
            case 'inicio':
                echo '<h2>🏠 Bienvenido al Inicio</h2>';
                echo '<p>Esta es la página principal de nuestra institución educativa.</p>';
                echo '<p>Usa los enlaces del menú y observa cómo cambia la URL con <code>?seccion=...</code></p>';
                break;

            case 'unidades':
                echo '<h2>📚 Unidades Académicas</h2>';
                echo '<p>Aquí encontrarás información sobre nuestras unidades de estudio.</p>';
                echo '<p>Ejemplo: Matemáticas, Lenguaje, Ciencias, Historia.</p>';
                break;

            case 'contacto':
                echo '<h2>📧 Contacto</h2>';
                echo '<p>Utiliza el formulario para comunicarte con nosotros.</p>';
                echo '<a href="contacto.php" class="btn-contacto">Ir al Formulario →</a>';
                break;

            default:
                echo '<h2>⚠️ Sección no encontrada</h2>';
                echo '<p>La sección solicitada no existe.</p>';
        }

        echo '</div>';
        ?>

    </div><!-- fin .container -->

</body>
</html>