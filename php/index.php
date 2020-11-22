<?php

//INICIAMOS LA SESION
session_start();
require_once '__varios.php';
$pdo = obtenerPdoConexionBD();

//SI EXISTE LA SESIÓN
if (isset($_SESSION['user_id'])) {
	//SELECCIONAMOS LA INFO DE ESTE USUARIO
	$sql = "SELECT * FROM users WHERE id = :id";
	$select = $pdo->prepare($sql);
	$select->bindParam(':id', $_SESSION['user_id']);
	$select->execute();
	$rs = $select->fetch(PDO::FETCH_ASSOC);

	$user = null;

	if (count($rs) > 0) {
		$user = $rs;
	}
}
?>



<!DOCTYPE html>
<html>

<head>
	<title>Bienvenido al Sistema de Logística</title>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<!-- REDIRIGE A ESTE MISMO ARCHIVO -->
	<header>
		<a href="/Logistica/Logistica-001/php">Sistema de Logística</a>
	</header>
	<!-- SI NO CERRAMOS SESIÓN  -->
	<?php if (!empty($user)) { ?>
		<h1>Bienvenido. <?= $user['email'] ?></h1>
		<h1>Estás dentor de nuestra App</h1>
		<a href="logout.php"></a>
	<?php } else { ?>
		<!-- SI LA SESIÓN ESTA CERRADO LE PEDMOS QUE SE REGISTRE O LA INICIE -->
		<h1>Porfavor Inicia Sesión o Regístrese</h1>
		<a href="login.php" style="text-decoration: none;">Iniciar sesión</a>
		<a href="signup.php" style="text-decoration: none;">Regístrarse</a>

	<?php } ?>
</body>

</html>