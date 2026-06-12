<?php
// Este archivo solo muestra el formulario
// No necesita procesar nada con PHP aquí
// Los datos viajan a procesar.php cuando el usuario envía el formulario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Institución Educativa</title>
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

        /* ── FORMULARIO ── */
        .container {
            max-width: 550px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
        .container h2 {
            color: #1a237e;
            margin-bottom: 8px;
        }
        .container p {
            color: #777;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* Cada campo del formulario */
        .campo {
            margin-bottom: 20px;
        }
        label {
            display: block;          /* Ocupa toda la línea */
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border 0.2s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #1a237e;   /* Borde azul al hacer clic */
            outline: none;
        }

        /* Botón enviar */
        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background: #1a237e;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }
        button[type="submit"]:hover { background: #283593; }

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
        <h2>📬 Formulario de Contacto</h2>
        <p>Completa los campos y haz clic en Enviar.</p>

        <!--
            action="procesar.php"  → a dónde se envían los datos al hacer clic en Enviar
            method="post"          → cómo viajan (ocultos, no en la URL)
        -->
        <form action="procesar.php" method="post">

            <div class="campo">
                <label for="nombre"> Nombre completo:</label>
                <!--
                    name="nombre" → con este nombre PHP lo recibe: $_POST['nombre']
                    required      → el campo no puede quedar vacío
                -->
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    placeholder="Ej: Robinson Rodríguez"
                    required
                >
            </div>

            <div class="campo">
                <label for="email"> Correo electrónico:</label>
                <!--
                    type="email"  → el navegador valida que tenga formato de correo
                    name="email"  → PHP lo recibe como: $_POST['email']
                -->
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Ej: robinson@correo.com"
                    required
                >
            </div>

            <button type="submit">Enviar mensaje →</button>

        </form>
    </div>

</body>
</html>