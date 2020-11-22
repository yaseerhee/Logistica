<?php
require_once "__varios.php";
$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];

$nuevoProducto = ($id == -1);
// SI ES NUEVO LAS VARIABLES ESTÁN VACÍAS
if ($nuevoProducto) {
    $productoCodigo = "";
    $productoNombre = "";
    $productoEstado = "";
    $producto_idc = "";
    // SI NO ES NUEVO SELECCIONAMOS LOS DATOS DE LA FILA DE ESE ID
} else {
    $sqlProducto = "SELECT id,nombre,estado, almacen_id FROM productos  WHERE id=?";

    $selectProducto = $pdo->prepare($sqlProducto);
    $selectProducto->execute([$id]);
    $rsProducto = $selectProducto->fetchAll();
    // COGEMOS LE CODIGO, EL NOMBRE, EL ESTADO Y ALMACEN DONDE ESTÁ DE ESA FILA Y LO MOSTRAMOS EN LA FICHA
    $productoCodigo = $rsProducto[0]["id"];
    $productoNombre = $rsProducto[0]["nombre"];
    $productoEstado = $rsProducto[0]["estado"];
    $producto_idc = $rsProducto[0]["almacen_id"];
}

//METEMOS EN OTRO SQL LA T_ALMACEN
$sqlAlmacen = "SELECT id, nombre FROM almacen";
$selectAlmacen = $pdo->prepare($sqlAlmacen);
$selectAlmacen->execute([]);
$rsAlmacen = $selectAlmacen->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="p-5">
    <div class="container h-100 text-center">
        <?php if ($nuevoProducto) { ?>
            <h1 class="1.75rem text-center text-primary">NUEVA FICHA DEL PRODUCTO</h1>
        <?php } else { ?>
            <h1 class="1.75rem text-center text-primary">FICHA DEL PRODUCTO</h1>
        <?php } ?>

        <form class="border p-3 form" method="post" action="productos-guardar.php">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <div class="form-group">
                <!-- INPUT DEL CODIGO OBLIGAMOS AL USUARIO A QUE META UN NUMERO MAYOR DE 0 Y QUE NO PUEDA HACER COPIA PEGA -->
                <input class="form-control" type="number" name="codigo" min="1" pattern="^[0-9]+" onpaste="return false;" onDrop="return false;" autocomplete=off <?php if ($nuevoProducto) {
                                                                                                                                                                        echo 'placeholder = "CODIGO"';
                                                                                                                                                                    } ?> value="<?= $productoCodigo ?>" />
            </div>

            <div class="form-group">
                <!-- INPUT DEL NOMBRE -->
                <input class="form-control" type="text" name="productoNombre" <?php if ($nuevoProducto) {
                                                                                    echo 'placeholder = "Nombre Producto"';
                                                                                } ?> value="<?= $productoNombre ?>" />
            </div>
            <div class="form-group">
                <!-- CONTROLAMOS EL CHECKBOX (0 = ESCASO, 1=BIEN) -->
                <label for="estado">Estado </label>
                <input type="hidden" name="estado" value="0">
                <input class="" type="checkbox" name="estado" value="1" <?php $productoEstado ? 'checked' : ' ' ?> />
            </div>
            <div class="form-group">
                <!-- EN EL SELECT MOSTRAMOS LOS ALMACENES DISPONIBLES QUE APARECEN EN NUESTRA BASE DE DATOS -->
                <select class="form-control" name="almacen_id">
                    <?php foreach ($rsAlmacen as $fila) { ?>
                        <option value="<?= $fila["id"] ?>" <?php if ($fila["id"] == $producto_idc) {
                                                                echo "selected = 'true'";
                                                            } ?>>
                            <?= $fila["nombre"] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <?php if ($nuevoProducto) { ?>
                <!-- BOTON PARA CREAR PRODUCTO -->
                <input class="btn btn-outline-primary" type="submit" id="boton" name="crear" value="Añadir producto" />
            <?php } else { ?>
                <!-- BOTON PARA NUEVO PRODUCTO -->
                <input class="btn btn-outline-primary" type="submit" id="boton" name="guardar" value="Guardar cambios" />
            <?php } ?>

        </form>

        <br />
        <!-- BOTON PARA ELIMINAR EL PRODUCTO -->
        <button type="submit" class="btn btn-outline-primary">
            <a href="productos-eliminar.php?id=<?= $id ?>">Eliminar Producto</a>
        </button>
        <!-- BOTON PARA IR AL LISTADO DE ELOS PRODUCTOS -->
        <button type="submit" class="btn btn-outline-primary">
            <a href="productos-lista.php">Listado de Productos.</a>
        </button>
    </div>
</body>

</html>