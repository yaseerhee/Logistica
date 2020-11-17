<?php

require_once "__varios.php";
$sql = "
           SELECT
                p.id     AS p_id,
                p.nombre AS p_nombre,
                p.estado AS p_estado,
                a.id     AS a_id,
                a.nombre AS a_nombre,
                a.lugar  AS a_lugar,
                p.almacen_id AS conexion
            FROM 
               productos AS p INNER JOIN almacen AS a
               ON p.almacen_id = a.id
            ORDER BY p.nombre
    ";
$pdo = obtenerPdoConexionBD();
$select = $pdo->prepare($sql);
$select->execute([]);
$personas = $select->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="p-5">

	<div class="container h-100 text-center">
        <h1>Listado de Productos</h1>
        <table class="table table-hover table-dark">
            <tr>
            	<th>Codigo Producto</th>
                <th>Producto</th>
                <th>Almacen</th>
                <th>Lugar</th>
                <th>Eliminar</th>
                <th>Estado</th>
            </tr>

            <?php foreach ($personas as $filaUnica) { ?>
                <tr>
                	<td>
                    	<a href="productos-ficha.php?id=<?= $filaUnica["p_id"] ?>"> <?= $filaUnica["p_id"] ?> </a>
                    </td>
                    <td>
                    	<a href="productos-ficha.php?id=<?= $filaUnica["p_id"] ?>"> <?= $filaUnica["p_nombre"] ?> </a>
                    </td>
                    <td>
                    	<a href="almacen-ficha.php?id=<?= $filaUnica["a_id"] ?>"> <?= $filaUnica["a_nombre"] ?> </a>
                    </td>
                     <td>
                    	<a href="almacen-ficha.php?id=<?= $filaUnica["a_id"] ?>"> <?= $filaUnica["a_lugar"] ?> </a>
                    </td>
                    <td>
                    	<a href="productos-eliminar.php?id=<?= $filaUnica["p_id"] ?>">
                    		<img src="img/img_X.png" width="30px" height="30px"> 
                    	</a>
                    </td>

                    <?php if ($filaUnica["p_estado"] == 1) { ?>
	                    <td>
	                    	<a href="productos-EstablecerEscasez.php?id=<?= $filaUnica["p_id"] ?>">
	                    		<img src="img/tic.jpg" width="30px" height="30px">
	                    	</a>
	                    </td>
                    <?php } else { ?>
	                    <td>
	                    	<a href="productos-EstablecerEscasez.php?id=<?= $filaUnica["p_id"] ?>">
	                    		<img src="img/exclamacion.png" width="30px" height="30px">
	                    	</a>
	                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>

        <br />

        <a href="productos-ficha.php?id=-1">Añadir un producto</a>


        <a href="almacen-lista.php">Listado de Productos</a>
    </div>
</body>
</html>