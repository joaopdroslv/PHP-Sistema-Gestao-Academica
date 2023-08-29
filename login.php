<?php
include('connection.php');

if( empty($_POST['username']) || empty($_POST['password'])) {
  header('Location: index.php');
} else {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  
  $query = "SELECT codigo, username FROM usuario WHERE username = '{$username}' AND senha = '{$password}'";
  $select = $conn->query($query);
  $data = mysqli_fetch_array($select);

  if($username === $data['username']) {
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $data['codigo'];
    $_SESSION['username'] = $username;
    mysqli_close($conn);
    header("Location: dashboard.php");
  } else {
    session_start();
    $_SESSION['login_fail'] = true;
    header('Location: index.php');
  }
}
?>