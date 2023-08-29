<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

if (isset($_POST['enviar'])) {

	$codigo = $_POST['codigo'];
    $curso = $_POST['curso'];
	$semestre = $_POST['semestre'];
	$periodo = $_POST['periodo'];

	// Mysql query to update record in a table
	$mysql_query = "UPDATE turma SET curso='{$curso}', semestre='{$semestre}', periodo='{$periodo}' WHERE codigo={$codigo}";

	if ($conn->query($mysql_query) === TRUE) {
		$msg = "update success";
		$msgerror = "";
	}
	else {
		$msg = "update error";
		$msgerror = $conn->error;
	}
	header("Location: turmas.php?msg={$msg}&msgerror={$msgerror}");
}

if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];
	$mysql_query = "SELECT * FROM turma WHERE codigo='{$codigo}'";
	$result = $conn->query($mysql_query);
	$row = mysqli_fetch_assoc($result);
}

mysqli_close($conn);	
?>

<div class="container p-3">
	<h2>Turmas</h2>
  	<p>Atualização do cadastro de turmas.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<input type="hidden" name="codigo" value="<?= $row['codigo']; ?>">
			<label for="curso">&nbsp;Curso</label>
			<input type="text" name="curso" id="curso" class="form-control" required value="<?= $row['curso']; ?>"><br>
			<label for="periodo">&nbsp;Periodo</label>
			<?php 
				if($row['periodo'] === "Diurno")
				{?>
			<select class="form-select" name="periodo">
				<option selected value="Diurno">Diurno</option>
				<option value="Noturno">Noturno</option>
			</select>
			<?php
				} else {?>
			<select class="form-select" name="periodo">
				<option value="Diurno">Diurno</option>
				<option selected value="Noturno">Noturno</option>
			</select>
				<?php
				}
			?><br>
			<label for="semestre">&nbsp;Semestre</label>
			<input type="number" name="semestre" id="semestre" class="form-control" value="<?= $row['semestre']; ?>"><br>
			<input type="submit" name="enviar" value="Atualizar" class="btn btn-dark w100">
		</form>
	</div>
</div>