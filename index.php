<?php
  session_start();
  include_once 'includes/checkSetCookie.inc.php';

  if(isset($_SESSION['user']))
  {
    header("Location: search/textSearch.php");
    $user = $_SESSION['user'];
    exit();
  }

  include_once 'header.php';

  if(isset($_GET['status']))
  {
    if($_GET['status']=='sentmail')
    {
      echo "<h5 style='text-align: justify;border: 1px inset blue;border-radius: 10px;background-color: #0ff;padding: 10px;font-size: 18px;line-height: normal;font-family: cursive;'>&nbsp;A verification mail has been sent to your IITK-email address.</h5>";
    }
  }

  elseif (isset($_GET['reset']))
  {

    if($_GET['reset']=='sentmail')
    {
      echo "<h5 style='text-align: justify;border: 1px inset blue;border-radius: 10px;background-color: #0ff;padding: 10px;font-size: 18px;line-height: normal;font-family: cursive;'>&nbsp;A reset password link has been sent to your IITK-email address.</h5>";
    }
    elseif($_GET['reset']=='nouser')
    {
      echo "<h5 style='text-align: justify;border: 1px inset black;border-radius: 10px;background-color: #000;padding: 10px;font-size: 18px;line-height: normal;font-family: cursive;color:white'>&nbsp;No user with this email address exist.</h5>";
    }
    elseif($_GET['reset']=='done')
    {
      echo "<h5 style='text-align: justify;border: 1px inset blue;border-radius: 10px;background-color: #0ff;padding: 10px;font-size: 18px;line-height: normal;font-family: cursive;'>&nbsp;Password reset complete. Now you can login</h5>";
    }

  }

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-md-6">
      <br><br><br><br>
      <div class="indexLogin container-fluid">
      <div class="row">
      <div class="col-lg-12 col-md-12">
      <form class="form-horizontal" action="includes/login.inc.php" method="POST" style="border:1px solid;border-radius:20px;background-color:#eee;padding:10px">

      <!-- Form Name -->
      <br>
      <center><h2>Log-In</h2></center><hr style="border:1px solid; width:50%"><br>
      <p id="showError" style="color:red;display:none"></p><br>

      <!-- Text input-->

      <div class="form-group">
      <label class="col-md-3 control-label">Username</label>
      <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input name="user_name" placeholder="Username" class="form-control" required type="text">
      </div>
      </div>
      </div>
      <br>

      <!-- Text input-->

      <div class="form-group">
      <label class="col-md-3 control-label">Password</label>
      <div class="col-md-8 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input name="user_password" placeholder="Password" class="form-control" required type="password">
      </div>
      <a class="pull-right" data-toggle="modal" data-target="#resetPass">Forgot Password?</a>
      </div>
      </div>
      <br>

      <!-- Button -->
      <div class="form-group loginSubmit">
      <div class="col-md-5 col-md-offset-5 col-sm-offset-4 col-sm-6">
      <button type="submit" class="btn btn-warning" name="submit"> Submit&nbsp; <span class="glyphicon glyphicon-send"></span></button>
      </div>
      </div>

      <p>First time users - <a href="signup.php">Register here</a></p>
      </form>
      </div>
      </div>
      </div>
    </div>
    <div id="startImage" class="col-lg-5 col-md-5 col-lg-offset-1 col-md-offset-1">
      <br><br><br><br><br>
      <img class="img-rounded" src="assets/icon.ico" width="70%">
    </div>
  </div>
</div>


<!-- Reset Password Modal -->
<div class="modal fade" id="resetPass" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body">
        <div class="text-center">
          <h3><i class="fa fa-lock fa-4x"></i></h3>
          <h2 class="text-center">Forgot Password?</h2>
          <p>You can reset your password here.</p>

            <form id="resetForm" role="form" class="form" action="includes/forgotPass.inc.php" method="post">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                  <input id="email" name="user_email" placeholder="IITK-email address" required class="form-control" type="email">
                </div>
              </div>
              <div class="form-group">
                <input name="recover-submit" class="btn btn-lg btn-primary" value="Reset Password" type="submit">
              </div>
            </form>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>


<?php
  include_once 'footer.php';

  if(isset($_GET['user']))
  {
    include_once 'includes/dbh.php';

    $sql = "SELECT * FROM users WHERE confirm_code=?;";
    $stmt = mysqli_stmt_init($conn);
    // prepare the prepared statement
    if( !(mysqli_stmt_prepare($stmt, $sql)) )
    {
      echo "SQL statemnt failed";
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"s",$_GET['user']);

        // Run parameters
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheck = mysqli_num_rows($result);

        // username already taken
        if($resultCheck > 0)
        {
          $data = mysqli_fetch_assoc($result);
          if($data['confirmed']==1)
          {
            echo "<script>$('#showError').html('Account already verified.You can login');$('#showError').css('color','green');
            $('#showError').css('display','block')</script>";
          }
          else {
            $sql = "UPDATE users SET confirmed = 1 WHERE confirm_code = '".$_GET['user']."';";
            mysqli_query($conn,$sql);

            echo "<script>$('#showError').html('Account verified.You can login');$('#showError').css('color','green');
            $('#showError').css('display','block')</script>";
          }
        }
      }
  }

  if(isset($_GET['login']))
  {
    if($_GET['login']=='failure')
    {
      echo "<script>document.getElementById('showError').innerHTML = '&nbsp;Invalid username or password';
      document.getElementById('showError').style.display = 'block';</script>";
    }
    elseif ($_GET['login']=='notverified')
    {
      echo "<script>document.getElementById('showError').innerHTML = '&nbsp;Account not yet verified';
      document.getElementById('showError').style.display = 'block';</script>";
    }
  }
?>
