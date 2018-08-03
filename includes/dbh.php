<?php

// $dbServerName = "db";
// $dbUserName = "root";
// $dbPassword = "hello123";
// $dbName = "studentSearch";
//
// $conn = mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);
//
// if (mysqli_connect_errno())
// {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   exit();
// }
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
