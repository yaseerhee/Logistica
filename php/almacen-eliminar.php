<?php
	require_once "__varios.php";

	$pdo = obtenerPdoConexionBD();
	$id = (int) $_REQUEST["id"]; 
	$sql = "DELETE FROM almacen WHERE id=?";

	$sentencia = $pdo->prepare($sql);
	$sql_con_exito = $sentencia->execute([$id]);

	$una_fila_afectada = ($sentencia->rowCount() == 1);
	$ninguna_fila_afectada = ($sentencia->rowCount() == 0);

	$correcto = ($sql_con_exito && $una_fila_afectada);
	$no_existia = ($sql_con_exito && $ninguna_fila_afectada);

?>


<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="p-5">
	<div class="container h-100 text-center">
        <?php if ($correcto) { ?>

            <h1 class="1.75rem text-center text-dark">Eliminación completada</h1>
            <p class="1.25rem text-center text-dark">Se ha eliminado correctamente el almacen.</p>

        <?php } else if ($no_existia) { ?>

            <h1 class="1.75rem text-center text-dark">Eliminación imposible</h1>
            <p class="1.25rem text-center text-dark">No existe el almacen que se pretende eliminar (¿ha manipulado Vd. el parámetro id?).</p>

        <?php } else { ?>

            <h1 class="1.75rem text-center text-dark">Error en la eliminación</h1>
            <p class="1.25rem text-center text-dark">No se ha podido eliminar el almacen o el almacen no existía.</p>

        <?php } ?>
        <button type="submit" class="btn btn-outline-primary">
        	<a href="almacen-lista.php">Volver al listado de almacenes.</a>
        </button>
    </div>
</body>

</html>