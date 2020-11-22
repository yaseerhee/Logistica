<?php

require_once "__varios.php";

$message = '';

if (
	!empty($_POST['email']) &&
	!empty($_POST['usuario']) &&
	!empty($_POST['password']) &&
	($_POST['password'] == $_POST['confirm_password'])
) {
	$pdo = obtenerPdoConexionBD();
	$sql = "INSERT INTO users (email, usuario, password) VALUES (:email, :usuario, :password)";
	$select = $pdo->prepare($sql);
	$select->bindParam(':email', $_POST['email']);
	$select->bindParam(':usuario', $_POST['usuario']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$select->bindParam(':password', $password);

	if ($select->execute()) {
		$message = 'Registro exitoso';
	} else {
		$message = 'Perdón ha habido un error creando su contraseña';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Registrarse</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<header>
		<a href="/Logistica/Logistica-001/php">Sistema de Logística</a>
	</header>

	<?php if (!empty($message)) { ?>
		<h1><?= $message; ?></h1>
	<?php } ?>

	<h1>Registrarse</h1>
	<span> o <a href="login.php">Inicie sesión</a></span>

	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="your@email.com" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
		<input type="text" name="usuario" placeholder="Usuario" required>
		<input type="password" name="password" placeholder="Crea contraseña" required>
		<input type="password" name="confirm_password" placeholder="Confirma contraseña" required>
		<input type="submit" name="Enviar">
	</form>
</body>

</html>