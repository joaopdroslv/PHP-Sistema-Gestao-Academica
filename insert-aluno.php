<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$data_nasc = $_POST['data_nasc'];
	$turma_codigo = $_POST['turma_codigo'];

	require_once('connection.php');

	// Mysql query to insert record into table
	$mysql_query = "INSERT INTO aluno (nome, cpf, data_nasc, turma_codigo) 
								VALUES ('{$nome}', '{$cpf}', '{$data_nasc}', '{$turma_codigo}')";
	
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

	header("Location: alunos.php?msg={$msg}&msgerror={$msgerror}");
}
?>

<div class="container p-3">
	<h2>Alunos</h2>
  	<p>Cadastro de aluno.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<label for="nome">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="cpf">&nbsp;CPF</label>
			<input type="text" name="cpf" id="cpf" class="form-control" maxlength="11" required><br>
			<label for="data_nasc">&nbsp;Data de Nascimento</label>
			<input type="date" name="data_nasc" id="data_nasc" class="form-control" style="width: 200px;"><br>
			<label for="turma_codigo">&nbsp;Codigo da Turma</label>
			<input type="text" name="turma_codigo" id="turma_codigo" class="form-control"required><br>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-dark w100 mt-3">
		</form>
	</div>
	<?php 
	require_once('connection.php');
	
	// Mysql query to select data from table
	$mysql_query = "SELECT * FROM turma ORDER BY codigo";
	$result = $conn->query($mysql_query);
	
	//Connection Close
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
