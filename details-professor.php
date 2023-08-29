<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

if(isset($_GET['codigo'])){
  $codigo = $_GET['codigo'];
}

require_once('connection.php');

$mysql_query = "SELECT * FROM professor WHERE codigo = '{$codigo}'";
$result = $conn -> query($mysql_query);

mysqli_close($conn);
?> 

<div class="container p-3">
  <h2>Professores</h2>
  <p>Listagem de detalhes de professores.</p>
  <hr>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 5%;">Código</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 30%;">CPF</th>
        <th scope="col" style="width: 15%;">Data Nascimento</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['nome']; ?></td> 
        <td style="text-align:center"><?php echo $data['cpf']; ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y', strtotime($data['data_nasc'])); ?></td>
        <td style="text-align:center">
          <a href="update-professor.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-professor.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
  <div class="float-right p-1">
    <a href="professores.php"><button type="button" class="btn btn-dark mb-3">Voltar</button></a>
  </div>
</div>

