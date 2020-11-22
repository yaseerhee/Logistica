<?php
require_once "__varios.php";
$pdo = obtenerPdoConexionBD();
//RECOGE LOS DATOS DE LA FICHA
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$lugar = $_REQUEST["lugar"];

$nuevoAlmacen = ($id == -1);
// SI ES NUEVO LOS INSERTA EN LA TABLA
if ($nuevoAlmacen) {
	$sql = "INSERT INTO almacen (nombre,lugar) VALUES (?,?)";
	$parametros = [$nombre, $lugar];
} else {
	//SI NO SON NUEVOS LOS MODIFICA EN LA TABLA
	$sql = "UPDATE almacen SET nombre=?, lugar=? WHERE id=?";
	$parametros = [$nombre, $lugar, $id];
}

$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute($parametros);

$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);

$correcto = ($sql_con_exito && $una_fila_afectada);
$datos_no_modificados = ($sql_con_exito && $ninguna_fila_afectada);

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="p-5">
	<div class="container h-100 text-center">
		<?php if ($correcto || $datos_no_modificados) { ?>
			<?php if ($id == -1) { ?>
				<!-- SI TODO SALE BIEN O NO HAY MODIFICACIONES  -->
				<h1 class="1.75rem text-center text-primary">INSERCIÓN COMPLETADA</h1>
				<p class="1.25rem text-center text-dark">Se ha insertado correctamente: <?php echo $nombre; ?>.</p>
			<?php } else { ?>
				<!-- CASO CONTRARIO LO GUARDA Y MODIFICA -->
				<h1 class="1.75rem text-center text-primary">GUARDADO COMPLETADO</h1>
				<p class="1.25rem text-center text-dark">Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

				<?php if ($datos_no_modificados) { ?>
					<!-- MODIFICACIONES 0 -->
					<p class="1.25rem text-center text-dark">En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de
						guardar</p>
				<?php } ?>
			<?php } ?>

		<?php } else { ?>
			<!--  EN CASO DE QUE CORRECTO SEA FALSE Y DATOSNOMODIFCADOS SEA FALSE -->
			<h1 class="1.75rem text-center text-primary">ERROR EN LA MODIFICACIÓN.</h1>
			<p class="1.25rem text-center text-dark">No se han podido guardar los datos del almacen.</p>
		<?php  }  ?>
		<!-- BOTÓN PARA VOLVER AL LISTADO DE ALMACENES -->
		<button type="submit" class="btn btn-outline-primary">
			<a href="almacen-lista.php">Volver al listado de almacenes.</a>
		</button>
	</div>
</body>

</html>