<?php
  session_start();
if(isset($_SESSION['user']))
{
  session_unset();
  session_destroy();
  setcookie("user_token","",time() - 1000, '/');

  header("Location: ../index.php");
  exit();
}
else {
  header("Location: ../index.php");
}
?>
