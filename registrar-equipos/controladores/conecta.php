<?php
// Conexion a la base de datos 
$server = "localhost";
$user = "root";
$pass = "";
$db = "equipos";

$conn = new mysqli($server, $user, $pass, $db);

// Se Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener el listado de equipo
$sql = "SELECT * FROM equipos";
$result = $conn->query($sql);

$equipos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $equipos[] = $row;
    }
}

$conn->close();
?>
