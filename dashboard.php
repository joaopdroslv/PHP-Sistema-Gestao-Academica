<?php 
session_start();

if (!isset($_SESSION['loggedin'])){
	header('Location: index.php');	
}
require_once("sidemenu.php");
require_once('connection.php');

$mysql_query = "SELECT count(*) as contador FROM aluno";
$result = $conn->query($mysql_query);
$data = mysqli_fetch_array($result);
$count_aluno = $data['contador'];

$mysql_query = "SELECT count(*) as contador FROM professor";
$result = $conn->query($mysql_query);
$data = mysqli_fetch_array($result);
$count_professor = $data['contador'];

$mysql_query = "SELECT count(*) as contador FROM disciplina";
$result = $conn->query($mysql_query);
$data = mysqli_fetch_array($result);
$count_disciplina = $data['contador'];

$mysql_query = "SELECT count(*) as contador FROM turma";
$result = $conn->query($mysql_query);
$data = mysqli_fetch_array($result);
$count_turma = $data['contador'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="w-100 d-flex m-5">
	<div class="container d-flex flex-column p-5 align-items-center justify-content-center">
		<h1 class="mb-5 text-center">Bem vindo ao Sistema de Gestão Academica</h1>
		<img src="dashboard-img.svg" width="500"alt="">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	</div>
	<div class="container d-flex flex-column p-5 align-items-center justify-content-center">
		<h1 class="mb-5 text-center">Visão geral dos registros do sistema</h1>
		<table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col">Registro</th>
        <th scope="col" style="width: 20%;">Quantidade</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <tr> 
        <td style="text-align:center">Alunos</td> 
        <td style="text-align:center"><?= $count_aluno ?></td>
        <td style="text-align:center">
          <a href="alunos.php">
            <button type="button" class="btn btn-dark">Acessar</button></a>
        </td> 
      </tr>      
      <tr> 
        <td style="text-align:center">Professores</td> 
        <td style="text-align:center"><?= $count_professor ?></td>
        <td style="text-align:center">
          <a href="professores.php">
            <button type="button" class="btn btn-dark">Acessar</button></a>
        </td> 
      </tr>      
      <tr> 
        <td style="text-align:center">Disciplinas</td> 
        <td style="text-align:center"><?= $count_disciplina ?></td>
        <td style="text-align:center">
          <a href="disciplinas.php">
            <button type="button" class="btn btn-dark">Acessar</button></a>
        </td> 
      </tr>      
      <tr> 
        <td style="text-align:center">Turmas</td> 
        <td style="text-align:center"><?= $count_turma ?></td>
        <td style="text-align:center">
          <a href="turmas.php">
            <button type="button" class="btn btn-dark">Acessar</button></a>
        </td> 
      </tr>      
    </tbody>
  </table>
	
	</div>
  </body>

</body>
</html>
