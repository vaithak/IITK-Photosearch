<?php
  session_start();

  if(isset($_SESSION['user']))
  {
    include_once 'login_header.php';
    $user = $_SESSION['user'];
  }
  else {
    header("Location: ../index.php");
    exit();
  }
?>

<br>
<div class="row">
  <div class="col l4 col m4 col offset-l1 col offset-m1">

    <h6 id="description">
      The photo you want to search will be matched with students' photo on OARS and with the photos that
      the person would have uploaded on his profile in this site. If you want to upload your photos on
      this site, you can do so by going to your profile page.
    </h6><br>

    <h5 style="text-align:center"><u>PhotoSearch</h5></u>

    <label for="imgInp" class="btn btn-primary btn-block">Choose an image to search<i class = "material-icons right">send</i></label>
    <input type="file" id="imgInp" accept="image/*" multple=false style="display: none">

    <br>
    <canvas id="myCanvas" width="400" height="300">
        Your browser does not support the HTML5 canvas tag.
    </canvas>

    <img id="search-image" style="display:none">

  </div>

  <div class="col l7 col m7">
    <?php include_once 'photoSearchResults.php' ?>
  </div>
</div>
