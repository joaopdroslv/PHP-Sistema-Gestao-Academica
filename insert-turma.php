<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

if (isset($_POST['enviar'])) {
    $curso = $_POST['curso'];
	$semestre = $_POST['semestre'];
	$periodo = $_POST['periodo'];

	require_once('connection.php');

	// Mysql query to insert record into table
	$mysql_query = "INSERT INTO turma (curso, semestre, periodo) 
								VALUES ('{$curso}', '{$semestre}', '{$periodo}')";
	
	$result = $conn->query($mysql_query);

	if ($result === TRUE) {
		$msg =  "insert success";
		$msgerror = "";
	}
	else {
		$msg =  "insert error";
		$msgerror = $conn->error;
	}

	//Connection Close
	mysqli_close($conn);

	header("Location: turmas.php?msg={$msg}&msgerror={$msgerror}");
}
?>

<div class="container p-3">
	<h2>Turmas</h2>
  	<p>Cadastro de turma.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<label for="curso">&nbsp;Curso</label>
			<input type="text" name="curso" id="curso" class="form-control" required><br>
			<label for="semestre">&nbsp;Semestre</label>
			<input type="number" name="semestre" id="semestre" class="form-control"required><br>
			<label for="semestre">&nbsp;Periodo</label>
			<select class="form-select" name="periodo">
				<option selected>Selecione um periodo...</option>
				<option value="Diurno">Diurno</option>
				<option value="Noturno">Noturno</option>
			</select>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-dark w100 mt-3">
		</form>
	</div>
</div>
