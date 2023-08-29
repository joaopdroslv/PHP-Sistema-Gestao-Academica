<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão Academica</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body class="w-100 d-flex vh-100">
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="dashboard.php" class="d-flex w-100 text-center align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <i class="fa-solid fa-book fa-bounce"></i>
      <span class="fs-4 text-center p-0 m-3">SGA</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="alunos.php" class="nav-link text-white" aria-current="page">
        <i class="fa-solid fa-user-graduate p-2"></i>
        Alunos
        </a>
      </li>
      <li class="nav-item">
        <a href="disciplinas.php" class="nav-link text-white">
        <i class="fa-solid fa-glasses p-2"></i>
        Disciplinas
        </a>
      </li>
      <li class="nav-item">
        <a href="professores.php" class="nav-link text-white">
        <i class="fa-solid fa-chalkboard-user p-2"></i>  
        Professores
        </a>
      </li>
      <li class="nav-item">
        <a href="turmas.php" class="nav-link text-white">
        <i class="fa-solid fa-people-group p-2"></i>
        Turmas
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a class="text-decoration-none text-white" href="users.php">
        <i class="fa-solid fa-circle-user p-2"></i>
        <?php echo "<strong>".strtoupper($_SESSION['username'])."</strong>" ?>
      </a>
      <a href="logout.php" class="d-flex align-items-center text-white text-decoration-none">
      <i class="fa-solid fa-arrow-right-from-bracket p-2"></i>
      SAIR
      </a>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/9c28322acb.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>

</body>
</html>
