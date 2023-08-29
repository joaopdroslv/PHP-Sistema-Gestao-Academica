<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

if($_SESSION["id"] === "1"){
    $mysql_query = "SELECT * FROM usuario";
  
  if (isset($_GET['filtrar'])) {
    $filtro = $_GET['filtro'];
    $valor = $_GET['valor'];
  
    if (!empty($filtro) && !empty($valor)) {
      if ($filtro == "codigo") {
        $mysql_query .= " WHERE codigo = '{$valor}'";
      } elseif ($filtro == "username") {
        $mysql_query .= " WHERE username LIKE '%{$valor}%'";
      }
    }
  }
    
  $mysql_query .= " ORDER BY codigo";

  $result = $conn->query($mysql_query);
?>

<div class="container p-3">
  <header>
    <h2>Seja bem vindo <?php echo "<span>".strtoupper($_SESSION["username"])."</span>"?></h2>
  </header>
  <hr>
  <section class="d-flex justify-content-between">
    <a href="insert-user.php"><button type="button" class="btn btn-dark">Adicionar Usuário</button></a>
    <form method="get" class="d-flex justify-content-between" style="width: 40%;">
      <select class="form-select" style="width: 30%;" name="filtro" id="filtro">
        <option value="" <?php echo empty($_GET['filtro']) ? 'selected' : ''; ?>>...</option>
        <option value="codigo" <?php echo $_GET['filtro'] === 'codigo' ? 'selected' : ''; ?>>Codigo</option>
        <option value="username" <?php echo $_GET['filtro'] === 'username' ? 'selected' : ''; ?>>Username</option>
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
        <th scope="col">Username</th>
        <th scope="col" style="width: 15%;">Data Criação</th>
        <th scope="col" style="width: 15%;">Data Atualização</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['username']; ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y H:i', strtotime($data['created_at'])); ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y H:i', strtotime($data['updated_at'])); ?></td> 
        <td style="text-align:center">
          <a href="update-user.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-user.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php
} else { 
  $mysql_query = "SELECT * FROM usuario WHERE codigo='{$_SESSION['id']}'";

  $result = $conn->query($mysql_query);

  $data = mysqli_fetch_array($result)
  ?>

<div class="container p-3">
  <h2>Seja bem vindo <?php echo "<span>".strtoupper($_SESSION["username"])."</span>"?></h2>
  <hr>
  <p>Usuário cadastrado em: <?php echo date('d/m/Y', strtotime($data['created_at']))?></p> 
    
    <a href="update-user.php?codigo=<?php echo $data['codigo']; ?>">
    <button type="button" class="btn btn-dark">Alterar senha</button></a>       
</div>


<?php } 
mysqli_close($conn);
?>