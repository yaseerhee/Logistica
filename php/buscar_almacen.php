<?php

require_once "__varios.php";
//convierte todo lo metido por el buscador en minúsculas
$busqueda = strtolower($_REQUEST['busqueda']);
//si esta vacía la variable de busqueda le redirige a la lista completa 
if (empty($busqueda)) {
    header("location: almacen-lista.php");
}

// CONSULTA A LA BASE DE DATOS ACERCA DE ALMACENES QUE CUMPLAN CON ESA CONDICIÓN (MISMO VALOR QUE EL METIDO POR EL BUSCADOR)
$pdo = obtenerPdoConexionBD();
$sql = "SELECT id,nombre,lugar FROM almacen WHERE nombre LIKE '%" . $busqueda . "%' || lugar LIKE '%" . $busqueda . "%' ORDER BY id";

$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="p-5">
    <div class="container h-100 text-center">
        <h1 class="1.75rem text-center text-primary" id="listado">LISTADO DE ALMACENES</h1>
        <!-- BUSCADOR DE ALMACENES -->
        <p></p>
        <form class="form-inline" action="buscar_almacen.php" method="get">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" type="text" name="busqueda" id="busqueda" placeholder="Buscar" aria-label="search" value="<?= $busqueda; ?>">
            <input type="submit" value="Buscar" class="btn btn-info">
        </form>
        <p></p>
        <!-- TABLA QUE IMPRIMA LOS REGISTROS SIMILARES A LOS BUSCADOS -->
        <table class="table table-hover table-dark">
            <tr>
                <th>NOMBRE</th>
                <th>LUGAR</th>
                <th>ELIMINAR</th>
            </tr>

            <?php foreach ($rs as $fila) { ?>
                <tr>
                    <td><a href="almacen-ficha.php?id=<?= $fila["id"] ?>"> <?= $fila["nombre"] ?></a></td>
                    <td><a href="almacen-ficha.php?id=<?= $fila["id"] ?>"> <?= $fila["lugar"] ?></a></td>
                    <td><a href="almacen-eliminar.php?id=<?= $fila["id"] ?>">
                            <img src="img/equis.png" width="25px" height="25px"> </a></td>
                </tr>
            <?php } ?>
        </table>

        <br />
        <div class="row justify-content-center h-100">
            <div class="col-lg-4">
                <!-- BOTON INTRODUCIR NUEVO ALMACEN -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="almacen-ficha.php?id=-1">Introducir nuevo almacen</a>
                </button>
            </div>
            <div class="col-lg-4">
                <!-- BOTON GESTIONAR LISTADO DE PRODUCTOS -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="productos-lista.php">Gestionar listado de productos</a>
                </button>
            </div>
            <div class="col-lg-4">
                <!-- BOTON CERRAR SESIONES -->
                <button type="submit" class="btn btn-outline-primary">
                    <a href="logout.php">Cerrar Sesión</a>
                </button>
            </div>
        </div>
    </div>
</body>

</html>