
<?php

if(isset($_GET['resetit']))
{

  include_once '../includes/dbh.php';

  $sql = "SELECT * FROM users WHERE reset_token=?;";
  $stmt = mysqli_stmt_init($conn);
  // prepare the prepared statement
  if( !(mysqli_stmt_prepare($stmt, $sql)) )
  {
    echo "SQL statemnt failed";
  }
  else
  {
      mysqli_stmt_bind_param($stmt,"s",$_GET['resetit']);

      // Run parameters
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $resultCheck = mysqli_num_rows($result);

      $data = mysqli_fetch_assoc($result);

      // username exists for confirm_code
      if($resultCheck == 0)
      {
        header("Location: ../index.php");
        exit();
      }
      else if($resultCheck > 0)
      {
        include_once '../header.php';
      }

    }
}
else
{
  header("Location: ../index.php");
  exit();
}

?>


<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
  <br><br>
<form onsubmit="return validate()" class="well form-horizontal" action="../includes/resetPass.inc.php" method="POST" style="border-radius:20px;">

<!-- Form Name -->
<center><br><h2>Reset Password</h2></center><br><br>

<!-- For showing error messages -->
<h5 style="color:red;display:none" id="error_show"></h5>


<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" >Password</label>
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="user-password" placeholder="Password" class="form-control" required type="password">
</div>
</div>
</div>

<!-- Reset token-->
<div style="display:none" class="form-group">
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<input name="user-token" class="form-control" value='<?php echo $data["user_pwd"]?>'>
</div>
</div>
</div>

<!-- Text input-->
<div class="form-group">
<label class="col-md-4 control-label" >Confirm Password</label>
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="confirm-password" placeholder="Confirm Password" class="form-control" required type="password">
</div>
</div>
</div>


<!-- Button -->
<div class="form-group">
<div class="col-md-4 pull-right"><br>
<button onclick="return validate()" type="submit" name="submit" class="btn btn-warning"> SUBMIT <span class="glyphicon glyphicon-send"></span></button>
</div>
</div>

</form>
</div>
</div>
</div>

<script>

    function validate()
    {
        var a = document.querySelector("input[name='user-password']").value;
        var b = document.querySelector("input[name='confirm-password']").value;
        console.log(a);
        if (a !== b) {
          console.log(a);
          document.getElementById("error_show").innerHTML = "Passwords do not match";
          document.getElementById('error_show').style.display = 'block';
           return false;
        }

        var user_input = document.querySelector("input[name='user-name']").value;
        if(!user_input.match(/^[a-zA-Z_0-9]*$/g))
        {
          document.getElementById("error_show").innerHTML = "Username can only have alphanumeric and underscore";
          document.getElementById('error_show').style.display = 'block';
          return false;
        }
    }

</script>
