<?php

session_start();

if(isset($_SESSION['user']))
{
  if(isset($_POST['version']))
  {
    include_once 'dbh.php';
    $sql = "UPDATE users SET images_uploaded = images_uploaded + 1, image".$_POST['number']."='".$_POST['version']."' WHERE user_uid = '".$_SESSION['user']."'";

    if(mysqli_query($conn,$sql))
    {
      echo "https://res.cloudinary.com/iitk-search/image/upload/v".$_POST['version']."/user_photos/".$_SESSION['user']."/".$_POST['number'].".jpg";
    }

  }
}

?>
