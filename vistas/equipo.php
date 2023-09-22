<?php
// Incluimos el archivo de conexión a la base de datos
include_once("../controladores/conecta.php");

// Pillamos la ID del equipo seleccionado
if (isset($_GET['equipo_id'])) {
    $equipo_id = $_GET['equipo_id'];
    // Realizamos una consulta para obtener los datos.
    $sql = "SELECT id, nombre, ciudad, deporte, fecha_creacion FROM equipos WHERE id = ?";
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
?>

<?

// Edito el jugador

if(isset($_GET["edita"])){
    $sql = "SELECT * FROM jugadores WHERE equipo = " . $equipo['id'];
	$resultado=$mysqli->query($sql)->fetch_assoc();
	?>
	<form method="post" action="equipo.php">
		<input type="hidden" name="id" value="<?= $resultado["id"]?>">
		
		Nombre <input type="text" name="nombre" placeholder="Nombre del jugador" value="<?= $resultado["nombre"]?>"><br><br>
		Apellido <input type="text" name="apellido" placeholder="Apellido" value="<?= $resultado["apellido"]?>"><br><br>
		Número <input type="number" name="numero" placeholder="número del jugador" value="<?= $resultado["numero"]?>"><br><br>
		
		<input type="submit" value="Enviar" name="edita">
	</form>
	<?
	die();
	
}

if(isset($_POST["edita"])){
	$_POST["nombre"]=trim($_POST["nombre"]);
	if($_POST["nombre"]==""){
		?>No has introducido ningún nombre<?
	}elseif(floatval($_POST["numero"])==0){
		?>No has puesto ningún número<?
	}elseif($_POST["apellido"]==""){
		?>No has puesto ningún apellido<?
	}else{
		$sql="update jugadores set nombre='".$_POST["nombre"]."',  
		numero='".$_POST["numero"]."', apellido='".$_POST["apellido"]."' WHERE id=".$_POST["edita"]." ";
		echo $sql;
		$mysqli->query($sql);
	}
}

// Fin: Edito al jugador

// Nuevo jugador

if(isset($_GET["nuevo"])){
	?>
	<form method="post" action="equipo.php">
        
        Nombre <input type="text" name="nombre" placeholder="Nombre del jugador" value="<?= $resultado["nombre"]?>"><br><br>
		Apellido <input type="text" name="apellido" placeholder="Apellido" value="<?= $resultado["apellido"]?>"><br><br>
		Número <input type="number" name="numero" placeholder="número del jugador" value="<?= $resultado["numero"]?>"><br><br>
		
        <input type="submit" value="Enviar" name="nuevo">
	</form>
	<?
	die();
}

if(isset($_POST["nuevo"])){
	$_POST["nombre"]=trim($_POST["nombre"]);
	if($_POST["nombre"]==""){
		?>No has introducido ningún nombre<?
	}elseif(floatval($_POST["numero"])==0.00){
		?>Has puesto ningún número al jugador<?
	}elseif($_POST["apellido"]==""){
		?>No has puesto ningún apellido<?
	}else{
		$sql = "insert into jugadores set nombre='".$_POST["nombre"]."', apellido='".$_POST["apellido"]."', numero='".$_POST["numero"]."' WHERE id=".$_POST["nuevo"]." ";
		echo $sql;
		$mysqli->query($sql);
	}
}

// fin de: Nuevo jugador

// Borro al jugador

if(isset($_GET["borra"])){
	$sql="delete from jugadores where id=".$_GET["borra"];
	$mysqli->query($sql);
	
}

// Fin: Borro el producto

// Pongo todas los productos

	include_once("conecta.php");
	// Consulta
	$sql="SELECT id, nombre, apellido, numero FROM jugadores WHERE id = $equipo_id; ";
	// Hago la consulta y guardo Sel resultado
	$resultado=$mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

  	?>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido<th>
			<th>Número</th>
			<th><a href="equipo.php?nuevo">&#10133;</a></th>
		</tr>
		<?
		for($i=0;$i<count($resultado);$i++){
			?>
			<tr>
				<td><?= $resultado[$i]["id"]?></td>
				<td><?= $resultado[$i]["nombre"]?></td>
				<td><?= $resultado[$i]["apellido"]?></td>
				<td><?= $resultado[$i]["numero"]?>
				
				</td>
					<td>
					<a href="productos.php?edita=<?= $resultado[$i]["id"]?>">&#9999;</a>
					<a href="productos.php?borra=<?= $resultado[$i]["id"]?>">&#128465;</a>		
					<a href="productos.php?foto=<?= $resultado[$i]["id"]?>">&#128396;</a>	
				</td>
			</tr>
			
			<?
		}
		?>
	</table>
	
	<a href="./listado_equipos.php">Volver al listado de equipos</a>
<?
// Fin de: Pongo todos los jugadores
?>
