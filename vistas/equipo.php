<?php
// Incluimos el archivo de conexión a la base de datos
include_once("../controladores/conecta.php");

// Pillamos la ID del equipo seleccionado
if (isset($_GET['equipo_id'])) {
    $equipo_id = $_GET['equipo_id'];
    // Realizamos una consulta para obtener los datos.
    $sql = "SELECT nombre, ciudad, deporte, fecha_creacion FROM equipos WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $equipo_id);
        
        // Se ejecuta la consulta
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            
            // Mostramos los detalles del equipo
            $equipo = $result->fetch_assoc();
            
            echo "<h1>Detalles del Equipo</h1>";
            echo "<p>El equipo " . $equipo['nombre'] . ", fundado el " . $equipo['fecha_creacion'] . " en la ciudad de " . $equipo['ciudad'] . ", compite en " . $equipo['deporte'] . ".</p>";

        } else {

            echo "Equipo no encontrado.";
        }
        
        // cerramos la consulta
        $stmt->close();
    } else {

        echo "Fallo al preparar la consulta: " . $mysqli->error;

    }
} else {

    echo "ID de equipo no proporcionado.";

}

// Cerramos la conexión a la base de datos
$mysqli->close();
?>
