<?php
require_once "__varios.php";

$pdo = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$productoCodigo = $_REQUEST["codigo"];
$productoNombre = $_REQUEST["productoNombre"];
$productoEstado = isset($_REQUEST["estado"]);
$producto_idc = $_REQUEST["almacen_id"];


$nuevoProducto = ($id == -1);

if ($nuevoProducto) {
    $sql = "INSERT INTO productos (id,nombre, estado,almacen_id) VALUES (?,?,?,?)";
    $parametros = [$productoCodigo, $productoNombre, $productoEstado, $producto_idc];
} else {
    $sql = "UPDATE productos SET id=?, nombre=?, estado=?, almacen_id=? WHERE id=?";
    $parametros = [$productoCodigo, $productoNombre, $productoEstado?1:0, $producto_idc, $id];
}

$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute($parametros);

$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);

$correcto = ($sql_con_exito && $una_fila_afectada);

$datos_no_modificados = ($sql_con_exito && $ninguna_fila_afectada);
?>


<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
    <div class="container h-100 text-center">
        <?php
        if ($correcto || $datos_no_modificados) { ?>

            <?php if ($id == -1) { ?>
                <h1 class="1.75rem text-center text-primary">PRODUCTO AÑADIDO</h1>
                <p class="1.25rem text-center text-dark">Se ha insertado correctamente la nueva entrada de <?php echo $productoNombre; ?>.</p>
            <?php } else { ?>
                <h1 class="1.75rem text-center text-primary">MODIFICACIÓN EXITOSA</h1>
                <p class="1.25rem text-center text-dark">Se han guardado correctamente los datos de <?php echo $productoNombre; ?>.</p>

                <?php if ($datos_no_modificados) { ?>
                    <p class="1.25rem text-center text-dark">En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de
                        guardar :)</p>
                <?php } ?>
            <?php }
            ?>

        <?php
        } else {
        ?>

            <h1 class="1.75rem text-center text-primary">ERROR AL MODIFICAR.</h1>
            <p class="1.25rem text-center text-dark">No se han podido guardar los datos de los productos.</p>

        <?php
        }
        ?>
        <button type="submit" class="btn btn-outline-primary">
            <a href="productos-lista.php">Volver al listado de productos.</a>
        </button>
    </div>
</body>

</html>