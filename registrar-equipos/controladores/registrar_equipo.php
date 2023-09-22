<?php
// Conexion a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "equipos";

$conn = new mysqli($server, $user, $pass, $db);

// Se verifica la conexion
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Se obtienen los datos del formulario
$nombre = $_POST['nombre'];
$ciudad = $_POST['ciudad'];
$fecha_creacion = $_POST['fecha_creacion'];
$deporte = $_POST['deporte'];


// Preparar una declaración SQL utilizando una consulta preparada
$sql = "INSERT INTO equipos (nombre, ciudad, fecha_creacion, deporte) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Vincular parámetros
$stmt->bind_param("ssss", $nombre, $ciudad, $deporte, $fecha_creacion);

// Ejecutar la declaración preparada
if ($stmt->execute()) {
    echo "Equipo agregado a la base de datos.";
} else {
    echo "Fallo al agregar equipo: " . $stmt->error;
}

// Cerrar la conexión y la declaración
$stmt->close();
$conn->close();
?>
