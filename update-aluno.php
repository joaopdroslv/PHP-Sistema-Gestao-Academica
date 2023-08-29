<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

if (isset($_POST['enviar'])) {
	$codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$data_nasc = $_POST['data_nasc'];
	$turma_codigo = $_POST['turma_codigo'];

	$mysql_query = "UPDATE aluno SET nome='{$nome}', cpf='{$cpf}', data_nasc='{$data_nasc}', turma_codigo ='{$turma_codigo}' WHERE codigo={$codigo}";

	if ($conn->query($mysql_query) === TRUE) {
		$msg = "update success";
		$msgerror = "";
	}
	else {
		$msg = "update error";
		$msgerror = $conn->error;
	}
	header("Location: alunos.php?msg={$msg}&msgerror={$msgerror}");
}

if (isset($_GET['codigo'])) {
	$codigo = $_GET['codigo'];
	$mysql_query = "SELECT * FROM aluno WHERE codigo={$codigo}";
	$result = $conn->query($mysql_query);
	$row = mysqli_fetch_assoc($result);
}
?>

<div class="container p-3">
	<h2>Alunos</h2>
  	<p>Atualização do cadastro de alunos.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<input type="hidden" name="codigo" value="<?= $row['codigo']; ?>">
			<label for="nome">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required value="<?= $row['nome']; ?>"><br>
			<label for="cpf">&nbsp;CPF</label>
			<input type="text" name="cpf" id="cpf" class="form-control"required value="<?= $row['cpf']; ?>"><br>
			<label for="data_nasc">&nbsp;Data de Nascimento</label>
			<input type="date" name="data_nasc" id="data_nasc" class="form-control"required value="<?= $row['data_nasc']; ?>"><br>
			<label for="turma_codigo">&nbsp;Código do Curso</label>
			<input type="number" name="turma_codigo" id="turma_codigo" class="form-control"required value="<?= $row['turma_codigo']; ?>"><br>
												
			<input type="submit" name="enviar" value="enviar" class="btn btn-dark w100">
		</form>
	</div>
	<?php 
	require_once('connection.php');

	$mysql_query = "SELECT * FROM turma ORDER BY codigo";
	$result = $conn->query($mysql_query);

	mysqli_close($conn);
	?> 
	<div class="container mt-5">
	  <table class="table table-striped table-bordered table-hover">
		<thead>
		  <tr class="table-dark" style="text-align:center">
			<th scope="col" style="width: 10%;">Código</th>
			<th scope="col">Curso</th>
			<th scope="col" style="width: 15%;">Semestre</th>
			<th scope="col" style="width: 15%;">Periodo</th>
		  </tr>
		</thead>
		<tbody>
		  <?php while($data = mysqli_fetch_array($result)) { ?> 
		  <tr> 
			<th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
			<td style="text-align:center"><?php echo $data['curso']; ?></td> 
			<td style="text-align:center"><?php echo $data['semestre']; ?></td> 
			<td style="text-align:center"><?php echo $data['periodo']; ?></td> 
		  </tr> 
		  <?php } ?>       
		</tbody>
	  </table>
	</div>
</div>

