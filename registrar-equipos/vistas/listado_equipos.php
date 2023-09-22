<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Equipos</title>
    <?php
    // Incluimos el archivo de conexión a la base de datos
    include_once("../controladores/conecta.php");
    ?>
</head>
<body>
    <h1><u>Listado de Equipos</u></h1>

    <?
    if (!empty($equipos)) {
    ?>
    <table>
        <tr><th>Nombre</th><th>Ciudad</th><th>Deporte</th><th>Fecha de Creación</th></tr>
        <?php foreach ($equipos as $equipo): ?>
        <tr>
            <td><?= $equipo['id'] ?></td>
            <td><?= $equipo['nombre'] ?></td>
            <td><?= $equipo['ciudad'] ?></td>
            <td><?= $equipo['deporte'] ?></td>
            <td><?= $equipo['fecha_creacion'] ?></td>
            <td><a href='equipo.php?equipo_id=<?= $equipo['id'] ?>'>Ver detalles del equipo</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
    } else {
        echo "No se encontraron equipos.";
    }
    ?>

    <a href="../index.html">Volver al formulario de registro de equipos</a>
</body>
</html>
