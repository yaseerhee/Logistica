<?php
session_start();
require_once '__varios.php';
$pdo = obtenerPdoConexionBD();

if (isset($_SESSION['user_id'])) {
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>

	<header>
		<a href="/Logistica/Logistica-001/php">Sistema de Logística</a>
	</header>
	<?php if (!empty($user)) { ?>
		<h1>Bienvenido. <?= $user['email'] ?></h1>
		<h1>Estás dentor de nuestra App</h1>
		<a href="logout.php"></a>
	<?php } else { ?>
		<h1>Porfavor Inicia Sesión o Regístrese</h1>
		<button type="submit" class="btn btn-outline-primary">
			<a href="login.php">Iniciar sesión</a>
		</button>
		<button type="submit" class="btn btn-outline-primary">
			<a href="signup.php">Regístrarse</a>
		</button>
	<?php } ?>
</body>

</html>