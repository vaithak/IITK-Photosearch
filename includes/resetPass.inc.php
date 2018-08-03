<?php

if (isset($_POST['submit']))
{

  include_once 'dbh.php';

  $code = $_POST['user-token'];
  $sql = "SELECT * FROM users WHERE user_pwd = ?;";
  $stmt = mysqli_stmt_init($conn);
  // prepare the prepared statement
  if( !(mysqli_stmt_prepare($stmt, $sql)) )
  {
    echo "SQL stateymnt failed";
  }
  else
  {

    mysqli_stmt_bind_param($stmt,"s",$code);

    // Run parameters
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck == 0)
    {
      header("Location: ../index.php");
      exit();
    }
    else
    {
      // HASHING THE PASSOWRD
      $hashedPwd = password_hash($_POST['user-password'], PASSWORD_DEFAULT);
      $data = mysqli_fetch_assoc($result);
      $random_hash_reset = md5(uniqid(rand(), true));
      //Insert the user into database
      $sql = "UPDATE users SET user_pwd = '".$hashedPwd."', reset_token = '".$random_hash_reset."' WHERE confirm_code = '".$data['confirm_code']."'; ";

      if(mysqli_query($conn,$sql))
      {
        header("Location: ../index.php?reset=done");
      }
    }
  }
}
