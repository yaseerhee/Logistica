<?php

require_once "__varios.php";
session_start();

$pdo = obtenerPdoConexionBD();
$sql = "SELECT id,nombre,lugar FROM almacen ORDER BY id";

$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="p-5">
    <div class="container h-100 text-center">
        <h1 class="1.75rem text-center text-primary" id="listado">LISTADO DE ALMACENES</h1>
        <h1 class="1.75rem text-center text-primary" id="listado"><?php echo $_SESSION["user_id"] ?></h1>
        <p></p>
        <form class="form-inline" action="buscar_almacen.php" method="get">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" type="text" name="busqueda" id="busqueda" placeholder="Buscar Almacen" aria-label="search">
            <input type="submit" value="Buscar" class="btn btn-info">
        </form>
        <p></p>
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
                <button type="submit" class="btn btn-outline-primary">
                    <a href="almacen-ficha.php?id=-1">Introducir nuevo almacen</a>
                </button>
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-outline-primary">
                    <a href="productos-lista.php">Gestionar listado de productos</a>
                </button>
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-outline-primary">
                    <a href="logout.php">Cerrar Sesión</a>
                </button>
            </div>
        </div>
    </div>
</body>

</html>