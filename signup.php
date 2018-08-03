<?php
  include_once 'header.php';

  // session_start();
  // to check if registered successfully
  if(isset($_SESSION['user']))
  {
    echo "hi";
    header("Location: search/textSearch.php");
    exit();
  }
?>

<div class="container">
<div class="row">
<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
  <br><br>
<form onsubmit="return validate()" class="well form-horizontal" action="includes/signup.inc.php" method="POST" style="border-radius:20px;">

<!-- Form Name -->
<center><br><h2>Sign-Up</h2></center><br><br>

<!-- For showing error messages -->
<h5 style="color:red;display:none" id="error_show">Hi</h5>

<!-- Text input-->

<div class="form-group">
<label class="col-md-4 control-label">First Name</label>
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="first-name" placeholder="First Name" class="form-control" required type="text">
</div>
</div>
</div>

<!-- Text input-->

<div class="form-group">
<label class="col-md-4 control-label" >Last Name</label>
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="last-name" placeholder="Last Name" class="form-control" required type="text">
</div>
</div>
</div>

<!-- Text input-->

<div class="form-group">
<label class="col-md-4 control-label">IITK-Username</label>
<div class="col-md-7 inputGroupContainer">
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input name="user-name" placeholder="IITK-Username" class="form-control" required type="text">
</div>
</div>
</div>

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

        function showError(error)
        {
          console.log(error);
          if(error == "usertaken")
          {
            document.getElementById("error_show").innerHTML = "Username Already Exists";
            document.getElementById('error_show').style.display = 'block';
          }
          else if(error == "invalid")
          {
            document.getElementById("error_show").innerHTML = "Invalid first or last name";
            document.getElementById('error_show').style.display = 'block';
          }
        }
</script>

<?php
  if(isset($_GET['signup']))
  {
    $err = filter_var($_GET['signup'],FILTER_SANITIZE_STRING);
    echo "<script>showError('$err')</script>";
  }
?>

<?php
  include_once 'footer.php';
?>
