<?php

//REALIZA EL CAMBIO DE ICONOS AL REALIZAR EL CHECK (cLICK EN LA IMAGEN)
require_once "__varios.php";
$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];

// ACTUALIZA LA BASE DE DATOS CON EL CAMBIO
$sql = "UPDATE productos SET estado = (NOT (SELECT estado FROM productos WHERE id=?)) WHERE id=?";
$select = $pdo->prepare($sql);
$select->execute([$id, $id]);
//rEDIRECCIONA A LA LISAT DE PRODUCTOS
redireccionar("productos-lista.php");

?>