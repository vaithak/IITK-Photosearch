<?php

if(!isset($_SESSION['user']) && isset($_COOKIE['user_token']))
{
  include_once 'dbh.php';
  // Using standard DES salts => 2 character
  $checkToken = crypt($_COOKIE['user_token'],'st');
  $sql = "SELECT * FROM users WHERE user_token = '".$checkToken."' ;";
  $result = mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck>0)
  {
    session_start();
    $data = mysqli_fetch_assoc($result);
    $new_user_token = md5(uniqid(rand(), true));
    $save_in_db = crypt($new_user_token,'st');
    $sql = "UPDATE users SET user_token = '".$save_in_db."' WHERE user_uid = '".$data['user_uid']."'; ";
    $_SESSION['user']=$data['user_uid'];

    if(mysqli_query($conn, $sql))
      setcookie("user_token",$new_user_token, time() + 60*60*24*365*5, '/');
  }
}

?>
