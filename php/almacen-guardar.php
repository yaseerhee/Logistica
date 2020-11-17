<?php
	require_once "__varios.php";

	$pdo = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];
	$nombre = $_REQUEST["nombre"];
	$lugar = $_REQUEST["lugar"];

	$nuevoAlmacen = ($id == -1);

	if ($nuevoAlmacen) {
	    $sql = "INSERT INTO almacen (nombre,lugar) VALUES (?,?)";
	    $parametros = [$nombre,$lugar];
	} else {
	    $sql = "UPDATE almacen SET nombre=? lugar=? WHERE id=?";
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
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="cuerpo">
        <?php     if ($correcto || $datos_no_modificados) { ?>

            <?php if ($id == -1) { ?>
                <h1>Inserción completada</h1>
                <p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
            <?php } else { ?>
                <h1>Guardado completado</h1>
                <p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

                <?php if ($datos_no_modificados) { ?>
                    <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de
                        guardar</p>
                <?php } ?>
            <?php } ?>

        <?php } else { ?>
            <h1>Error en la modificación.</h1>
            <p>No se han podido guardar los datos de la categoría.</p>
        <?php  }  ?>

        <a href="almacen-lista.php">Volver al listado de categorías.</a>
    </div>
</body>
</html>