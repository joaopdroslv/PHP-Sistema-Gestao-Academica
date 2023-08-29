<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['id'] !== "1"){
  header('Location: index.php');	
} 

require("sidemenu.php");

if (isset($_POST['enviar'])) {
    $username = $_POST['username'];
	$password = $_POST['password'];

	require_once('connection.php');

	// Mysql query to insert record into table
	$mysql_query = "INSERT INTO usuario (username, senha) 
								VALUES ('{$username}', '{$password}')";
	
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

	header("Location: users.php?msg={$msg}&msgerror={$msgerror}");
}
?>

<div class="container p-3">
	<h2>Usuário</h2>
  	<p>Cadastro de usuário.</p>
  	<hr>  	
	<div class="wrapper">
		<form method="post">
			<label for="username">&nbsp;Username</label>
			<input type="text" name="username" id="username" class="form-control" required><br>
			<label for="password">&nbsp;Password</label>
			<input type="number" name="password" id="password" class="form-control"required><br>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-dark w100 mt-3">
		</form>
	</div>
</div>
