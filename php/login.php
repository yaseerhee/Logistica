<?php
session_start();


if (isset($_SESSION['user_id'])) {
	header('/Logistica/Logistica-001/php/');
}
require_once "__varios.php";

$pdo = obtenerPdoConexionBD();


if (!empty($_POST['email']) && !empty($_POST['usuario']) && !empty($_POST['password'])) {
	$sql = "SELECT email, usuario, password FROM users WHERE usuario= :usuario && email = :email ";
	$select = $pdo->prepare($sql);
	$select->bindParam(':usuario', $_POST['usuario']);
	$select->bindParam(':email', $_POST['email']);
	$select->execute();
	$rs = $select->fetch(PDO::FETCH_ASSOC);

	$message = '';
	if (
		count($rs) > 0
		&& password_verify($_POST['password'], $rs['password'])
	) {
		$_SESSION['user_id'] = $rs['id'];
		header('Location: /Logistica/Logistica-001/php/almacen-lista.php');
	} else {
		$message = 'Perdón estás credenciales no coinciden';
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
	<header>
		<a href="/Logistica/Logistica-001/php">Sistema de Logística</a>
	</header>
	<?php if (!empty($message)) { ?>
		<p><?= $message; ?></p>
	<?php } ?>

	<h1>Inicia Sesión</h1>
	<span> o <a href="signup.php">Regístrese</a></span>

	<form action="login.php" method="post">
		<input type="text" name="email" placeholder="your@email.com" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
		<input type="text" name="usuario" placeholder="Usuario" required>
		<input type="password" name="password" placeholder="Contraseña" required>
		<input type="submit" name="Enviar">
	</form>
</body>

</html>