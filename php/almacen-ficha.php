<?php
require_once "__varios.php";

$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];
$nuevoAlmacen = ($id == -1);

if ($nuevoAlmacen) {
    $nombre = "";
    $lugar = "";
} else {
    $sql = "SELECT nombre, lugar FROM almacen WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    $nombre = $rs[0]["nombre"];
    $lugar = $rs[0]["lugar"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="contenedor">
        <?php if ($nuevoAlmacen) { ?>
            <h1>Nueva ficha del almacen</h1>
        <?php } else { ?>
            <h1>Ficha del almacen</h1>
        <?php } ?>

        <form action="almacen-guardar.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <ul id="lista">
                <li>
                    <label for="nombre">NOMBRE: </label>
                    <input type="text" name="nombre" value="<?= $nombre ?>">
                </li>

                <li>
                    <label for="lugar">LUGAR: </label>
                    <input type="text" name="lugar" value="<?= $lugar ?>">
                </li>
            </ul>
            <?php if ($nuevoAlmacen) { ?>
                <input type="submit" name="anhadir" value="Añadir nuevo almacen">
            <?php } else { ?>
                <input type="submit" name="guardar" value="Guardar cambios">
            <?php } ?>
        </form>

        <button type="submit" class="btn btn-outline-primary" >
            <a href="almacen-eliminar.php?id=<? $id ?>">Eliminar almacen de la lista</a>
        </button>
        <button type="submit" class="btn btn-outline-primary">
            <a href="almacen-lista.php">Lista del almacen</a>
        </button>

    </div>
</body>

</html>