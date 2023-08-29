<?php

session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

$mysql_query = "SELECT * FROM turma";

if (isset($_GET['filtrar'])) {
  $filtro = $_GET['filtro'];
  $valor = $_GET['valor'];

  if (!empty($filtro) && !empty($valor)) {
    if ($filtro == "codigo") {
      $mysql_query .= " WHERE codigo = '{$valor}'";
    } elseif ($filtro == "curso") {
      $mysql_query .= " WHERE curso LIKE '%{$valor}%'";
    }
  }
}

$mysql_query .= " ORDER BY codigo";

$result = $conn -> query($mysql_query);

mysqli_close($conn);
?> 
<div class="container p-3">
<header>
    <h2>Turmas</h2>
    <p>Listagem de turmas cadastradas.</p>
  </header>
  <hr>
  <section class="d-flex justify-content-between">
    <a href="insert-turma.php"><button type="button" class="btn btn-dark">Adicionar Turma</button></a>
    <form method="get" class="d-flex justify-content-between" style="width: 40%;">
      <select class="form-select" style="width: 30%;" name="filtro" id="filtro">
        <option value="" <?php echo empty($_GET['filtro']) ? 'selected' : ''; ?>>...</option>
        <option value="codigo" <?php echo $_GET['filtro'] === 'codigo' ? 'selected' : ''; ?>>Codigo</option>
        <option value="curso" <?php echo $_GET['filtro'] === 'curso' ? 'selected' : ''; ?>>Curso</option>
      </select>
      <input type="text" name="valor" id="valor" class="form-control" style="width: 45%;" value="<?php echo isset($_GET['valor']) ? $_GET['valor'] : ''; ?>"><br>
      <input type="submit" value="Filtrar" name="filtrar" class="btn btn-dark" style="width: 20%;">
    </form>
  </section>
  <br>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 10%;">Código</th>
        <th scope="col">Curso</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['curso']; ?></td> 
        <td style="text-align:center">
          <a href="details-turma.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Detalhes</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>