<!DOCTYPE html>
<html lang="en">

<head>
  <title>IITK-Student-Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="includes/css/indexStyle.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="start">
  <nav class="navbar navbar-inverse">

    <div class="container-fluid">

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">IITK-Student-Search</a>
      </div>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php">Home</a></li>
          <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
            <ul class="header-form dropdown-menu">

              <div class="container-fluid">
                <div class="row">
                  <br>
                  <form class="form-horizontal" action="includes/login.inc.php" method="POST">
                    <div class="form-group">
                      <i class="fa fa-user col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1" style="font-size:25px;color:blue"></i>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <input type="text" class="form-control" id="uid" placeholder="Username" name="user_name">
                      </div>
                    </div>
                    <div class="form-group">
                      <i class="fa fa-key col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1" style="font-size:25px;color:blue; align:right"></i>
                      <div class="col-lg-8 col-md-8 col-sm-8">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="user_password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10 col-md-offset-2 col-md-10 col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-default" name="submit">Submit</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </ul>
          </li>
        </ul>
      </div>

    </div>
  </nav>
