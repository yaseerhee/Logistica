<?php
	require_once "__varios.php";

	$pdo = obtenerPdoConexionBD();

	$id = (int)$_REQUEST["id"];
	$sql = "DELETE FROM productos WHERE id=?";

	$sentencia = $pdo->prepare($sql);
	$sql_con_exito = $sentencia->execute([$id]);

	$una_fila_afectada = ($sentencia->rowCount() == 1);
	$ninguna_fila_afectada = ($sentencia->rowCount() == 0);

	$correcto = ($sql_con_exito && $una_fila_afectada);
	$no_existia = ($sql_con_exito && $ninguna_fila_afectada);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="p-5">
	<div class="cuerpo">
        <?php if ($correcto) { ?>

            <h1>Eliminación completada</h1>
            <p>Se ha eliminado correctamente el producto.</p>

        <?php } else if ($no_existia) { ?>

            <h1>Eliminación imposible</h1>
            <p>No existe la persona que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

        <?php } else { ?>

            <h1>Error en la eliminación</h1>
            <p>No se ha podido eliminar el producto o el producto no existía.</p>

        <?php } ?>

        <a href="productos-lista.php">Volver al listado de productos.</a>
    </div>
</body>
</html>