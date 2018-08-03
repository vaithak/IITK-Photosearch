<?php

// to ensure that actually submit button is clicked and not just url changed
if (isset($_POST['submit']))
{
  include_once 'dbh.php';

  $first = filter_var($_POST['first-name'],FILTER_SANITIZE_STRING);
  $last = filter_var($_POST['last-name'],FILTER_SANITIZE_STRING);
  $user = $_POST['user-name'];
  $pwd = $_POST['user-password'];
  $email = $user.'@iitk.ac.in';

  if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))
  {
    header("Location: ../signup.php?signup=invalid");
    exit();
  }
  else
  {
    // create a prepared statement
    $sql = "SELECT * FROM users WHERE user_uid=?;";
    $stmt = mysqli_stmt_init($conn);
    // prepare the prepared statement
    if( !(mysqli_stmt_prepare($stmt, $sql)) )
    {
      echo "SQL stateymnt failed";
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"s",$user);

        // Run parameters
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);

        // username already taken
        if($resultCheck > 0)
        {
          header("Location: ../signup.php?signup=usertaken");
          exit();
        }
        // new username to register
        else
        {
          // HASHING THE PASSOWRD
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

          //Insert the user into database
          $sql = "INSERT INTO users (user_first,user_last,user_email,user_uid,user_pwd,confirmed,confirm_code,reset_token) VALUES (?,?,?,?,?,?,?,?);";

          // now using Prepared statements
          if(!mysqli_stmt_prepare($stmt,$sql))
          {
            echo "SQL statemnt failed";
          }
          else
          {
            // bind parameters
            $random_hash = md5(uniqid(rand(), true));
            $random_hash_reset = md5(uniqid(rand()+1, true));
            $confirmed = 0;
            mysqli_stmt_bind_param($stmt,"sssssiss",$first,$last,$email,$user,$hashedPwd,$confirmed,$random_hash,$random_hash_reset);

            // Run parameters
            mysqli_stmt_execute($stmt);
            // session_start();

            require '../vendor/autoload.php';

            $from = new SendGrid\Email(null, "iitksearch@gmail.com");
            $to = new SendGrid\Email(null, $email);// Send email to our user
            $subject = 'Signup | Verification'; // Give the email a subject
            $content = new SendGrid\Content("text/plain",'

            Thanks for signing up!
            Your account has been created with following username.

            ------------------------
            Username: '.$user.'
            ------------------------

            Please click this link to activate your account:
            https://iitk-search.herokuapp.com/index.php?user='.$random_hash.'

            '); // Our message above including the link
            $mail = new SendGrid\Mail($from, $subject, $to, $content);

            //$headers = 'From:noreply@iitkphotosearch.com' . "\r\n"; // Set from header
            $apiKey = getenv('SENDGRID_API_KEY');
            $sg = new \SendGrid($apiKey);
            $response = $sg->client->mail()->send()->post($mail);
            if($response->statusCode()==202)
            {
              header("Location: ../index.php?status=sentmail");
              exit();
            }
          }
        }
    }
  }

}
else {
  header("Location: ../signup.php");
  exit();
}
