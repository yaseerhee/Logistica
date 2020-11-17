<?php
require_once "__varios.php";
$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];

$nuevoProducto = ($id == -1);

if ($nuevoProducto) {
    $productoCodigo = "";
    $productoNombre = "";
    $almacenNombre = "";
    $almacenLugar = "";
    $productoEstado = "";
    $producto_idc = "";

} else {
    $sqlProducto = "SELECT * FROM productos  WHERE id=? ";

    $selectProducto = $pdo->prepare($sqlProducto);
    $selectProducto->execute([$id]); 
    $rsProducto = $selectProducto->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $productoCodigo = $rsProducto[0]["codigo"];
    $productoNombre = $rsProducto[0]["productoNombre"];
    $almacenNombre = $rsProducto[0]["almacenNombre"];
    $almacenLugar = $rsProducto[0]["almacenLugar"];
    $productoEstado = $rsProducto[0]["estado"];
    $producto_idc = $rsProducto[0]["almacen_id"];
}
$sqlAlmacen = "SELECT * FROM almacen";
$selectAlmacen = $pdo->prepare($sqlAlmacen);
$selectAlmacen->execute([]);
$rsAlmacen = $selectAlmacen->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="p-5">
<div class="container">
        <?php if ($nuevoProducto) { ?>
            <h1>Nueva ficha de Producto</h1>
        <?php } else { ?>
            <h1>Ficha de Producto</h1>
        <?php } ?>

        <form method="post" action="persona-guardar.php">

            <input type="hidden" name="id" value="<?= $id ?>" />

            <ul>
                <li>
                    <label for="codigo">Codigo Producto: </label>
                    <input type="text" name="codigo" <?php if ($nuevoProducto) {
                                                            echo 'placeholder = "codigo"';
                                                        } ?> value="<?= $productoCodigo ?>" />
                </li>
                <li>
                    <label for="productoNombre">Nombre Producto: </label>
                    <input type="text" name="productoNombre" <?php if ($nuevoProducto) {
                                                            echo 'placeholder = "Nombre Producto"';
                                                        } ?> value="<?= $productoNombre ?>" />
                </li>
                <li>
                    <label for="estado">Estado </label>
                    <input type="hidden" name="estado" value="0">
                    <input type="checkbox" name="estado" value="1" <?php $productoEstado ? 'checked': ' ' ?> />
                </li>
                <li>
                    <label for="almacen_id">Nombre Almacen: </label>
                    <select name="almacen_id">
                        <?php foreach ($rsAlmacen as $fila) { ?>
                            <option value="<?= $fila["id"] ?>" <?php if ($fila["id"] == $producto_idc) {
                                                                    echo "selected = 'true'";
                                                                } ?>><?= $fila["almacenNombre"] ?></option>
                        <?php
                        } ?>
                    </select>
                </li>
            </ul>

            <?php if ($nuevoProducto) { ?>
                <input type="submit" id="boton" name="crear" value="Añadir persona" />
            <?php } else { ?>
                <input type="submit" id="boton" name="guardar" value="Guardar cambios" />
            <?php } ?>

        </form>

        <br />

        <a href="productos-eliminar.php?id=<?= $id ?>">Eliminar Personas</a>

        <a href="productos-lista.php">Listado de Personas.</a>
    </div>
</body>
</html>