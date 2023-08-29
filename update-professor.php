<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];
	$mysql_query = "SELECT * FROM professor WHERE codigo={$codigo}";
	$result = $conn -> query($mysql_query);
	$row = mysqli_fetch_assoc($result);
}

if (isset($_POST['enviar'])) {
	$codigo = $_POST['codigo'];
	$nome = $_POST['nome'];
	$cpf = $_POST['CPF'];
	$datanasc = $_POST['datanasc'];

	$mysql_query = "UPDATE professor SET nome='{$nome}', cpf='{$cpf}', data_nasc='{$datanasc}' WHERE codigo={$codigo}";

	if ($conn -> query($mysql_query) === TRUE) {
		$msg = "update success";
		$msgerror = "";
	}
	else {
		$msg = "update error";
		$msgerror = $conn->error;
	}
	
	header("Location: professores.php?msg={$msg}&msgerror={$msgerror}");
}

// Connection Close
mysqli_close($conn);	
?>

<div class="container p-3">
	<h2>Professores</h2>
  	<p>Atualização do cadastro de Professores.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<input type="hidden" name="codigo" value="<?= $row['codigo']; ?>">
			<label for="name">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required value="<?= $row['nome']; ?>"><br>
			<label for="CPF">&nbsp;CPF</label>
			<input type="text" name="CPF" id="CPF" class="form-control" required maxlength="11" value="<?= $row['cpf']; ?>"><br>
			<label for="datanasc">&nbsp;Data de Nascimento</label>
			<input type="date" name="datanasc" id="datanasc" class="form-control" required value="<?= $row['data_nasc']; ?>"><br>
			<input type="submit" name="enviar" value="Atualizar" class="btn btn-dark w100">
		</form>
	</div>
</div>

