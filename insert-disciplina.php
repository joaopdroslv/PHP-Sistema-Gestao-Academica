<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

if (isset($_POST['enviar'])) {
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];
	$codigo_professor = $_POST['professor'];
	$codigo_turma = $_POST['turma'];
	
	$mysql_query = "INSERT INTO disciplina (nome, descricao, professor_codigo, turma_codigo) 
								VALUES ('{$nome}', '{$descricao}', '{$codigo_professor}', '{$codigo_turma}')";
	
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

	header("Location: disciplinas.php?msg={$msg}&msgerror={$msgerror}");
} else {
	$mysql_query = "SELECT * FROM professor ORDER BY nome";
	$result_professor = $conn -> query($mysql_query); #result

	$mysql_query = "SELECT * FROM turma ORDER BY curso";
	$result_turma = $conn -> query($mysql_query); #result

	mysqli_close($conn);
}
?>

<div class="container p-3">
	<h2>Disciplinas</h2>
  	<p>Adicionar Disciplinas.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<label for="name">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="descricao">&nbsp;Descrição</label>
			<input type="text" name="descricao" id="descricao" class="form-control"required><br>

            <label for="professor">&nbsp;Professor</label>
			<select name="professor" id="professor" class="form-control">
                <option selected>...</option>
                <?php while($professor = mysqli_fetch_array($result_professor, MYSQLI_ASSOC)) { ?>
                    <option value="<?= $professor['codigo'] ?>"><?= $professor['nome'] ?></option>
                <?php } ?>
            </select><br>

            <label for="turma">&nbsp;Turma</label>
            <select name="turma" id="turma" class="form-control">
                <option selected>...</option>
                <?php while($turma = mysqli_fetch_array($result_turma, MYSQLI_ASSOC)) { ?>
                    <option value="<?= $turma['codigo'] ?>"><?= $turma['curso'] ?></option>
                <?php } ?>
            </select><br>

			<input type="submit" name="enviar" value="Inserir" class="btn btn-dark w100">
		</form>
	</div>
</div>

