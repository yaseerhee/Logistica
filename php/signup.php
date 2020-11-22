<?php

require_once "__varios.php";
$message = '';

//COMPRONBAMOS QUE NO ESTÉ NINGÚN CAMPO VACÍO
if (
	!empty($_POST['email']) &&
	!empty($_POST['usuario']) &&
	!empty($_POST['password']) &&
	//COMPROBAMOS QUE COINCIDA LA CONTRASEÑA
	($_POST['password'] == $_POST['confirm_password'])
) {
	//INSERTAMOS LOS REGISTROS EN LA TABLA USUARIO
	$pdo = obtenerPdoConexionBD();
	$sql = "INSERT INTO users (email, usuario, password) VALUES (:email, :usuario, :password)";
	$select = $pdo->prepare($sql);
	$select->bindParam(':email', $_POST['email']);
	$select->bindParam(':usuario', $_POST['usuario']);
	//ENCRIPTAMOS LA CONTRASEÑA
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$select->bindParam(':password', $password);
	// si se ejecuta devuelve este mnsj
	if ($select->execute()) {
		$message = 'Registro exitoso';
	} else {
		// si no se ejecuta devuelve este mnsj
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
	<!-- SI EL MNSJ NO ESTA VACÍO IMPRIMELO -->
	<?php if (!empty($message)) { ?>
		<h1><?= $message; ?></h1>
	<?php } ?>

	<h1>Registrarse</h1>
	<span> o <a href="login.php">Inicie sesión</a></span>
	<!-- FORMULARIO DEL REGISTRO -->
	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="your@email.com" required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$">
		<input type="text" name="usuario" placeholder="Usuario" required>
		<input type="password" name="password" placeholder="Crea contraseña" required>
		<input type="password" name="confirm_password" placeholder="Confirma contraseña" required>
		<input type="submit" name="Enviar">
	</form>
</body>

</html>