<?php

if(isset($_POST['recover-submit']))
{
  include_once 'dbh.php';

  $email = $_POST['user_email'];

  $sql = "SELECT * FROM users WHERE user_email=?;";
  $stmt = mysqli_stmt_init($conn);

  if( !(mysqli_stmt_prepare($stmt, $sql)) )
  {
    echo "SQL stateymnt failed";
  }
  else
  {
    mysqli_stmt_bind_param($stmt,"s",$email);

    // Run parameters
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultCheck = mysqli_num_rows($result);

    // username already taken
    if($resultCheck > 0)
    {
      $data = mysqli_fetch_assoc($result);

      require '../vendor/autoload.php';

      $from = new SendGrid\Email(null, "iitksearch@gmail.com");
      $to = new SendGrid\Email(null, $email);// Send email to our user
      $subject = 'Reset Password'; // Give the email a subject
      $content = new SendGrid\Content("text/plain",'

      Hi '.$data['user_first'].', a password-reset request was made for your account.

      Please click this link to reset password for your account:
      https://iitk-search.herokuapp.com/resetPass/resetPass.php?resetit='.$data['reset_token'].'

      ');

      // Our message above including the link
      $mail = new SendGrid\Mail($from, $subject, $to, $content);

      //$headers = 'From:noreply@iitkphotosearch.com' . "\r\n"; // Set from header
      $apiKey = getenv('SENDGRID_API_KEY');
      $sg = new \SendGrid($apiKey);
      $response = $sg->client->mail()->send()->post($mail);

      // GIVE STATUS OF SUCCESFULL MAILING
      if($response->statusCode()==202)
      {
        header("Location: ../index.php?reset=sentmail");
        exit();
      }

    }
    else
    {
      header("Location: ../index.php?reset=nouser");
      exit();
    }
  }

}
else
{
    header("Location: ../index.php");
}
