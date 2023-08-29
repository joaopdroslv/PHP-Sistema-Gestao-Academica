<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Portal do Aluno</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/style.css">
</head>
<body class="w-100 d-flex">
	<div class="w-75 img-background"></div>
	<div class="w-25 d-flex justify-content-center align-items-center">
		<div class="card w-100 h-100 ">
			<div class="card-body d-flex flex-column align-items-center justify-content-center">
				<img src="https://clipground.com/images/user-login-icon-png-1.png" width="150" alt="" class="pt-lg-5">
				<h1 class="text-center pt-2">Sistema Gerencial</h1>
				<h3 class="text-center pb-4">Login</h3>
				<?php	if(isset($_SESSION['login_fail'])) {	?>
					<div class="alert alert-warning">
						<strong>ERRO: Usuário e/ou senha inválidos</strong>
					</div>
				<?php	} unset($_SESSION['login_fail']) ?>
				<form class="h-100 w-100 d-flex flex-column justify-content-start" action="login.php" method="POST">
					<div class="form-group mt-3">
						<label for="username">Usuário:</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group mt-3">
						<label for="password">Senha:</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<button type="submit" class="btn btn-dark mt-3">Entrar</button>
					<a href="esqueci_senha.html" class="btn pe-auto text-decoration-none text-black-50">Esqueci minha senha</a>
				</form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>

</body>
</html>
