<?php

require_once "__varios.php";
$pdo = obtenerPdoConexionBD();

//FILTRAMOS LA TABLA SI NOS QUEDAMOS CON LOS PRODUCTOS QUE SU ESTADO VALE 0 QUE EQUIVALE A ESCASEZ
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
            WHERE 
                p.estado = 0 
            ORDER BY p.id
    ";

$select = $pdo->prepare($sql);
$select->execute([]);
$productos = $select->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="p-5">
    <!-- TABLA DE PRODUCTOS QUE ESCASEAN (EXCLAMACIÓN) -->
	<div class="container h-100 text-center">
        <h1 class="1.75rem text-center text-primary">PRODUCTOS QUE ESTÁN ESCASEANDO</h1>
        <table class="table table-hover table-dark">
            <tr>
            	<th>Codigo Producto</th>
                <th>Producto</th>
                <th>Almacen</th>
                <th>Lugar</th>
                <th>Eliminar</th>
                <th>Estado</th>
            </tr>
            <!-- IMPRIME TODAS LAS FILAS QUE CUMPLEN ESTÁ CONDICIÓN -->
            <?php foreach ($productos as $filaUnica) { ?>
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
                    		<img src="img/equis.png" width="30px" height="30px"> 
                    	</a>
                    </td>
                    <!-- SI EL ESTADO DEL PRODUTO ES 1 APARECE EL ICONO DEL TIC, AQUÍ NO APARECE PORQUE SOLO APARECEN LOS QUE HAN ESCASEADO -->
                    <?php if ($filaUnica["p_estado"] == 1) { ?>
	                    <td>
	                    	<a href="productos-EstablecerEscasez.php?id=<?= $filaUnica["p_id"] ?>">
	                    		<img src="img/tic.png" width="30px" height="30px">
	                    	</a>
	                    </td>
                    <?php } else { ?>
                    <!-- SI EL ESTADO DEL PRODUTO ES 0 APARECE EL ICONO DE LA EXCLAMACION -->
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

        <div class="row justify-content-center h-100">
            <div class="col-lg-4">
            <!-- BOTON AÑADIR PRODUCTO -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="productos-ficha.php?id=-1">Añadir un producto</a>
                </button>
            </div>
            <div class="col-lg-4">
            <!-- BOTÓN LISTADO DE ALMACENES -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="almacen-lista.php">Listado de Almacenes</a>      
                </button>
            </div>
            <div class="col-lg-4">
            <!-- BOTÓN CERRAR SESIÓN -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="logout.php">Cerrar Sesión</a>
                </button>
            </div>
        </div>
        <br />
    </div>
</body>
</html>