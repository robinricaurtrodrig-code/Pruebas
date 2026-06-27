
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DE CONTACTOS</title>
</head>
<body>
    <H1>Contacto</H1>
    <form method="POST" action="index.php?action=guardar">

<label> Nombre:</label><br>
<input type="text" name="nombre" required><br><br>

<label> Correo:</label><br>
<input type="email" name="correo" required><br><br>

<label> Asunto:</label><br>
<input type="text" name="asunto" required><br><br>

<label> Mensaje:</label><br>
<textarea name="mensaje" required></textarea><br><br>

<button type= "submit">Enviar</button>
    </form>
    <br>
    <a href="index.php?action=lista">Ver mensaje enviados</a>
</body>
</html>