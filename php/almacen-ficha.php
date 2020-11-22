<?php
require_once "__varios.php";

$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];
$nuevoAlmacen = ($id == -1);
// SI ES NUEVO LAS VARIABLES ESTÁN VACÍAS
if ($nuevoAlmacen) {
    $nombre = "";
    $lugar = "";
} else {
    // SI NO ES NUEVO SELECCIONAMOS LOS DATOS DE LA FILA DE ESE ID
    $sql = "SELECT nombre, lugar FROM almacen WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();
    // COGEMOS LE NOMBRE Y EL LUGAR DE ESA FILA Y LO MOSTRAMOS EN LA FICHA
    $nombre = $rs[0]["nombre"];
    $lugar = $rs[0]["lugar"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body class="p-5">
    <div class="container h-100 text-center">
        <?php if ($nuevoAlmacen) { ?>
            <h1 class="1.75rem text-center text-primary">NUEVA FICHA DEL ALMACEN</h1>
        <?php } else { ?>
            <h1 class="1.75rem text-center text-primary">FICHA DEL ALMACEN</h1>
        <?php } ?>
        <div class="abs-center">
            <form class="border p-3 form" action="almacen-guardar.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group">
                    <!-- SI LAS VARIABLES ESTÁN VACÍAS EL INPUT APARECE VACÍO SI ESTÁN LLENAS NOS MUESTRA EL VALOR DE DICHA -->
                    <input class="form-control" type="text" name="nombre" value="<?= $nombre ?>" placeholder="NOMBRE ALMACEN">
                </div>
                <div class="form-group">
                    <!-- SI LAS VARIABLES ESTÁN VACÍAS EL INPUT APARECE VACÍO SI ESTÁN LLENAS NOS MUESTRA EL VALOR DE DICHA -->
                    <input class="form-control" type="text" name="lugar" value="<?= $lugar ?>" placeholder="LUGAR ALMACEN">
                </div>
                <div class="row justify-content-center h-100">
                    <div class="col-lg-4">
                        <?php if ($nuevoAlmacen) { ?>
                            <!-- si es nuevo imprime este botón -->
                            <input class="btn btn-outline-primary" type="submit" name="anhadir" value="Añadir nuevo almacen">
                        <?php } else { ?>
                            <!-- si no es nuevo imprime este botón -->
                            <input class="btn btn-outline-primary" type="submit" name="guardar" value="Guardar cambios">
                        <?php } ?>
                    </div>
                    <div class="col-lg-4">
                        <!-- BOTON REDIRIGE AL LISTADO DEL ALMACEN -->
                        <button type="submit" class="btn btn-outline-primary">
                            <a href="almacen-lista.php">Lista del almacen</a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>