<?php
require_once "__varios.php";
$pdo = obtenerPdoConexionBD();
$id = (int)$_REQUEST["id"];

$sql = "UPDATE productos SET estado = (NOT (SELECT estado FROM productos WHERE id=?)) WHERE id=?";
$select = $pdo->prepare($sql);
$select->execute([$id, $id]);

redireccionar("productos-lista.php");

?>