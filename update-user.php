<?php
session_start();

if (!isset($_SESSION['loggedin'])){
	header('Location: index.php');	
} 

require("sidemenu.php");

require_once('connection.php');

if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];
	$mysql_query = "SELECT * FROM usuario WHERE codigo='{$codigo}'";
	$result = $conn -> query($mysql_query);
	$row = mysqli_fetch_assoc($result);
}

if (isset($_POST['enviar'])) {
	$codigo = $_POST['codigo'];
	$senha = $_POST['senha'];
	
	if($_SESSION['id'] === "1"){
		$username = $_POST['username'];
	} else {
		$username = $_SESSION['username'];
	}

	$mysql_query = "UPDATE usuario SET username='{$username}', senha='{$senha}', updated_at=now() WHERE codigo='{$codigo}'";

	if ($conn -> query($mysql_query) === TRUE) {
		$msg = "update success";
		$msgerror = "";
	}
	else {
		$msg = "update error";
		$msgerror = $conn->error;
	}
	header("Location: users.php?msg={$msg}&msgerror={$msgerror}");
}

if($_SESSION['id'] === "1"){	
?>

<div class="container p-3">
	<h2>Usuários</h2>
	<p>Atualização do cadastro de usuário.</p>
	<hr>  	
	<div class="wrapper">
		<form method="post">
			<input type="hidden" name="codigo" value="<?= $row['codigo']; ?>">
			<label for="username">&nbsp;Username</label>
			<input type="text" name="username" id="username" class="form-control" required value="<?= $row['username']; ?>"><br>
			<label for="senha">&nbsp;Senha</label>
			<input type="text" name="senha" id="senha" class="form-control" required value="<?= $row['senha']; ?>"><br>
			<input type="submit" name="enviar" value="Atualizar" class="btn btn-dark w100">
		</form>
	</div>
</div>

<?php } else { 

?>
<div class="container p-3">
	<h2>Usuários</h2>
	<p>Atualização do cadastro de usuário.</p>
	<hr>  	
	<div class="wrapper">
		<form method="post">
			<input type="hidden" name="codigo" value="<?= $row['codigo']; ?>">
			<label for="username">&nbsp;Username</label>
			<input type="text" name="username" id="username" class="form-control"  required value="<?= $row['username']; ?>" disabled><br>
			<label for="senha">&nbsp;Senha</label>
			<input type="text" name="senha" id="senha" class="form-control" required value="<?= $row['senha']; ?>"><br>
			<input type="submit" name="enviar" value="Atualizar" class="btn btn-dark w100">
		</form>
	</div>
</div>

<?php }

mysqli_close($conn);	
?>


