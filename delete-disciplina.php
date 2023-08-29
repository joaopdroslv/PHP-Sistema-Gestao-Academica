<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    require_once('connection.php');

    $mysql_query = "DELETE FROM disciplina WHERE codigo = $codigo";

    if ($conn -> query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }
    else {
        $msg =  "delete error";
        $msgerror = $conn->error;
    }

    mysqli_close($conn);
} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location: disciplinas.php?msg={$msg}&msgerror={$msgerror}");
?>