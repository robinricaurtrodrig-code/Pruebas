<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes Recibidos</title>
</head>
<body>
    <h1>Lista de Mensajes Recibidos</h1>

    <?php if (empty($mensajes)): ?>
        <p>No hay mensajes recibidos.</p>

    <?php else: ?>

        <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Asunto</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>

<?php foreach ($mensajes as $mensaje): ?>
        <tr>
            <td><?php echo $mensaje['id']; ?></td>
            <td><?php echo $mensaje['nombre']; ?></td>
            <td><?php echo $mensaje['correo']; ?></td>
            <td><?php echo $mensaje['asunto']; ?></td>
            <td><?php echo $mensaje['mensaje']; ?></td>
            <td><?php echo $mensaje['fecha']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <br>
    <a href="index.php?action=formulario">Volver al formulario</a>

</body>
</html>