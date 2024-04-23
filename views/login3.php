<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
	header('location: ./menu.php');
	// You may want to remove this echo statement unless it's for debugging purposes
	// echo "sesion" . $_SESSION['id_usuario'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/login3.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
</head>

<body>
	<div id="successModal"></div>
	<h2>Inicia sesión y podrás pedir todo lo que necesitas en el evento!!</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form method="post" id="registro">
				<h1>Create Account</h1>
				<input type="text" placeholder="Name" name="nombre" required />
				<input type="email" placeholder="Email" name="correo" required />
				<input type="password" placeholder="Password" name="password" required />
				<button type="submit">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form id="forming" class="form" method="post">
				<h1>Inicia sesión</h1>
				<hr>
				<input type="email" placeholder="Email" name="correo" required />
				<input type="password" placeholder="Password" name="password" required />
				<button type="submit">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Animate, crea una nueva cuenta!</h1>
					<p>Conéctate y recibe un servicio de calidad</p>
					<button class="ghost" id="signIn">Ya tengo una cuenta</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Vamos, únete y recibe el mejor servicio</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<script src="../js/login.js"></script>
	<script src="../js/registro.js"></script>
	<script src="../js/login3.js"></script>
</body>

</html>
