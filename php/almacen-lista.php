<?php

require_once "__varios.php";

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
        <h1 id="listado">LISTADO DE ALMACENES</h1>

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
                            <img src="img/img_X.png" width="25px" height="25px"> </a></td>
                </tr>
            <?php } ?>
        </table>

        <br />
        <a href="almacen-ficha.php?id=-1">Introducir nuevo almacen</a>
        <a href="productos-lista.php">Gestionar listado de productos</a>
    </div>
</body>

</html>