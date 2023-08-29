<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

if (isset($_POST['enviar'])) {
	$nome = $_POST['nome'];
	$cpf = $_POST['CPF'];
	$datanasc = $_POST['datanasc'];

	require_once('connection.php');
	
	$mysql_query = "INSERT INTO professor (nome, cpf, data_nasc) 
								VALUES ('{$nome}', '{$cpf}', '{$datanasc}')";
	
	$result = $conn -> query($mysql_query);

	if ($result === TRUE) {
		$msg =  "insert success";
		$msgerror = "";
	}
	else {
		$msg =  "insert error";
		$msgerror = $conn->error;
	}

	mysqli_close($conn);

	header("Location: professores.php?msg={$msg}&msgerror={$msgerror}");
}
?>

<div class="container p-3">
	<h2>Professores</h2>
  	<p>Adicionar Professor</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<label for="name">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="CPF">&nbsp;CPF</label>
			<input type="text" name="CPF" id="CPF" class="form-control"required><br>
			<label for="datanasc">&nbsp;Data de Nascimento</label>
			<input type="date" name="datanasc" id="datanasc" class="form-control" style="width: 200px;"><br>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-dark w100">
		</form>
	</div>
</div>

