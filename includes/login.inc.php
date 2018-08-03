<?php

if(isset($_POST['submit']))
{
  include_once 'dbh.php';

  $user_entered = $_POST['user_name'];
  $sql = "SELECT * FROM users WHERE user_uid=?;";
  $stmt = mysqli_stmt_init($conn);

  if( !(mysqli_stmt_prepare($stmt, $sql)) )
  {
    echo "SQL statemnt failed";
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"s",$user_entered);

      // Run parameters
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0)
      {
        $data = mysqli_fetch_assoc($result);
        if(password_verify($_POST['user_password'],$data['user_pwd']))
        {
          if($data['confirmed']==1)
          {
            session_start();
            $new_user_token = md5(uniqid(rand(), true));
            // Using standard DES salts => 2 character
            $save_in_db = crypt($new_user_token,'st');
            $sql = "UPDATE users SET user_token = '".$save_in_db."' WHERE user_uid = '".$data['user_uid']."'; ";
            $_SESSION['user']=$user_entered;

            setcookie("user_token", $new_user_token, time() + 60*60*24*365*5, '/');
            if(mysqli_query($conn,$sql))
            {
              header("Location: ../search/textSearch.php");
              exit();
            }
          }
          else if($data['confirmed']==0)
          {
            header("Location: ../index.php?login=notverified");
            exit();
          }
        }
        else {
          header("Location: ../index.php?login=failure");
          exit();
        }
      }
      else {
        header("Location: ../index.php?login=failure");
        exit();
      }
  }
}
else
{
  header("Location: ../index.php");
  exit();
}
