<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['id'] !== "1"){
    header('Location: index.php');	
} 

require("sidemenu.php");

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM usuario WHERE codigo='{$codigo}'";

    if ($conn->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }
    else {
        $msg =  "delete error";
        $msgerror = $conn->error;
    }

    // Connection Close
    mysqli_close($conn);
} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location: users.php?msg={$msg}&msgerror={$msgerror}");
?>