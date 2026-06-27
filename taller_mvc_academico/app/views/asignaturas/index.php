<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Asignaturas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; max-width: 900px; }
        th, td { border: 1px solid #999; padding: 10px; text-align: left; }
        th { background: #004080; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        form { margin-bottom: 20px; }
        input, button { padding: 8px; }
        a { margin-left: 10px; }
    </style>
</head>
<body>
    <?php
        $asignaturas = $asignaturas ?? [];
        $busqueda = $busqueda ?? '';
    ?>
    <h1>Catálogo Académico</h1>

    <form method="GET" action="index.php">
        <input type="hidden" name="r" value="asignaturas">
        <label>Buscar asignatura:
            <input type="text" name="buscar"
                   value="<?= htmlspecialchars($busqueda) ?>">
        </label>
        <button type="submit">Buscar</button>
        <a href="index.php?r=asignaturas&mostrar=todas">Mostrar todas</a>
    </form>

    <?php if (count($asignaturas) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Nivel</th>
                    <th>Docente</th>
                    <th>Horas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asignaturas as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['id']) ?></td>
                        <td><?= htmlspecialchars($a['nombre_asignatura']) ?></td>
                        <td><?= htmlspecialchars($a['nivel']) ?></td>
                        <td><?= htmlspecialchars($a['docente']) ?></td>
                        <td><?= htmlspecialchars(substr($a['horas'] ?? '', 0, 5)) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron asignaturas.</p>
    <?php endif; ?>
</body>
</html>
