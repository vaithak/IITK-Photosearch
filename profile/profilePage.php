<?php
session_start();

include_once '../includes/checkSetCookie.inc.php';

if(!isset($_SESSION['user']))
{
  header("Location: ../index.php");
  exit();
}

include_once 'profileHeader.php';
$uploadPreset = getenv('CLOUDINARY_UPLOAD_PRESET');

if(isset($_GET['upload']))
{
  if($_GET['upload']=="success")
  {
    echo "<h5 style='text-align: justify;border: 1px inset blue;border-radius: 10px;background-color: #0ff;padding: 10px;font-size: 18px;line-height: normal;font-family: cursive;'>&nbsp;Succesfully uploaded an Image.</h5>";
  }
}

?>

  <div class="profileStart">
    <div class="container">
      <br>

      <div class="row">
        <div class="col l6 col m6 col s10 col offset-l3 col offset-m3 col offset-s1">
          <h4 id="heading">Your uploaded photos</h4>
          <p style="text-align:center">You can't change the photos once uploaded</p>
          <p style="text-align:center">(Please refresh the page if photos are not visible)</p>
        </div>
      </div>

      <hr>

      <div class="row">

        <div class="col l5 col m5 col s12 ">
          <div class="imgCard">
            <div class="cardText">
              <h5><b>#1</b></h5>
            </div>

            <?php

            include_once '../includes/dbh.php';
            $sql = "SELECT images_uploaded,image1,image2,image3,image4 FROM users where user_uid = '".$_SESSION['user']."' ;";

            $result = mysqli_query($conn,$sql);

            $data = mysqli_fetch_assoc($result);
            // echo $data;
            if($data['images_uploaded'] >= 1)
            {
              echo "<canvas width='400' height='400' id='myCanvas1' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage1' src='https://res.cloudinary.com/iitk-search/image/upload/v".$data['image1']."/user_photos/".$_SESSION['user']."/1.jpg' style='display:none'>";
            }
            else {
              echo "

                <button class='btn btn-primary btn-block' id='upload_image1' style='width:100%'>Upload Image<i class = 'material-icons right'>send</i></button>

              <canvas width='400' height='400' id='myCanvas1' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage1' src='../assets/person.jpg' style='display:none'>";
            }

            ?>

          </div>
        </div>

        <div class="col l5 col m5 col s12 col offset-l2 col offset-m2">
          <div class="imgCard">
            <div class="cardText">
              <h5><b>#2</b></h5>
            </div>

            <?php

            if($data['images_uploaded'] >= 2)
            {
              echo "<canvas width='400' height='400' id='myCanvas2' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage2' src='https://res.cloudinary.com/iitk-search/image/upload/v".$data['image2']."/user_photos/".$_SESSION['user']."/2.jpg' style='display:none'>";
            }
            else {
              echo "
                <button class='btn btn-primary btn-block' id='upload_image2' style='width:100%'>Upload Image<i class = 'material-icons right'>send</i></button>

              <canvas width='400' height='400' id='myCanvas2' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage2' src='../assets/person.jpg' style='display:none'>";
            }

            ?>

          </div>
        </div>

      </div>

      <div class="row">

        <div class="col l5 col m5 col s12 ">
          <div class="imgCard">
            <div class="cardText">
              <h5><b>#3</b></h5>
            </div>

            <?php

            if($data['images_uploaded'] >= 3)
            {
              echo "<canvas width='400' height='400' id='myCanvas3' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage3' src='https://res.cloudinary.com/iitk-search/image/upload/v".$data['image3']."/user_photos/".$_SESSION['user']."/3.jpg' style='display:none'>";
            }
            else {
              echo "
                <button class='btn btn-primary btn-block' id='upload_image3' style='width:100%'>Upload Image<i class = 'material-icons right'>send</i></button>

              <canvas width='400' height='400' id='myCanvas3' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage3' src='../assets/person.jpg' style='display:none'>";
            }

            ?>

          </div>
        </div>

        <div class="col l5 col m5 col s12 col offset-l2 col offset-m2">
          <div class="imgCard">
            <div class="cardText">
              <h5><b>#4</b></h5>
            </div>

            <?php

            if($data['images_uploaded'] >= 4)
            {
              echo "<canvas width='400' height='400' id='myCanvas4' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage4' src='https://res.cloudinary.com/iitk-search/image/upload/v".$data['image4']."/user_photos/".$_SESSION['user']."/4.jpg' style='display:none'>";
            }
            else {
              echo "
                <button class='btn btn-primary btn-block' id='upload_image4' style='width:100%'>Upload Image<i class = 'material-icons right'>send</i></button>

              <canvas width='400' height='400' id='myCanvas4' >
                  Your browser does not support the HTML5 canvas width='300' height='300' tag.
              </canvas>

              <img id='uploadedImage4' src='../assets/person.jpg' style='display:none'>";
            }

            ?>

          </div>
        </div><br>

      </div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
  $(document).ready(function(){

    $(".button-collapse").sideNav();

    var canvas1 = document.getElementById("myCanvas1");
    var ctx1 = canvas1.getContext("2d");
    var img1 = document.getElementById("uploadedImage1");


    img1.onload = function(){
      ctx1.drawImage(img1,0,0,canvas1.width,canvas1.height);
    };

    img1.src = img1.src;

    var canvas2 = document.getElementById("myCanvas2");
    var ctx2 = canvas2.getContext("2d");
    var img2 = document.getElementById("uploadedImage2");


    img2.onload = function(){
      ctx2.drawImage(img2,0,0,canvas2.width,canvas2.height);
    };

    img2.src = img2.src;

    var canvas3 = document.getElementById("myCanvas3");
    var ctx3 = canvas3.getContext("2d");
    var img3 = document.getElementById("uploadedImage3");


    img3.onload = function(){
      ctx3.drawImage(img3,0,0,canvas3.width,canvas3.height);
    };

    img3.src = img3.src;

    var canvas4 = document.getElementById("myCanvas4");
    var ctx4 = canvas4.getContext("2d");
    var img4 = document.getElementById("uploadedImage4");


    img4.onload = function(){
      ctx4.drawImage(img4,0,0,canvas4.width,canvas4.height);
    };

    img4.src = img4.src;

    function imageUpload(number,version)
    {
      if(number > <?php echo $data['images_uploaded'] ?>)
      {
        $.ajax({
          url: "../includes/imageUpload.inc.php",
          type: "post",
          data: {
            number: <?php echo ($data['images_uploaded']+1) ?>,
            version: version
          },
          success: function(response){
            console.log(response);

            var imgObj = {
              "image": response,
              "subject_id": '<?php echo $_SESSION['user']; ?>' + '_<?php echo $data['images_uploaded']+1; ?>',
              "gallery_name":"photosearch_fin2"
            }

            var data = {"process":"enroll"};
            data.imgObj = JSON.stringify(imgObj);

            $.ajax({
              url: "../search/requestImage.php",
              method: "POST",
              data: data,

              success:function(response2){
                console.log(response2);
              }
            });


          }
        });
      }
    }

    // function to change the image according to the one selected by user
    $("#upload_image1").cloudinary_upload_widget(
        {
          cloud_name: 'iitk-search', upload_preset: '<?php echo $uploadPreset ?>',
          cropping: 'server', folder: 'user_photos' ,
          sources:[ 'local', 'url', 'facebook', 'instagram'] , multiple:false,
          resource_type: 'image',
          client_allowed_formats: ["png", "jpeg", "jpg"],
          max_file_size: 200000,
          type:"private",
          public_id: "<?php echo $_SESSION['user'];?>/<?php echo ($data['images_uploaded']+1) ?>"
        },function(error, result)
          {
            $('.cloudinary-thumbnails').remove();
            $("#upload_image4").siblings('img').attr("src","https://res.cloudinary.com/iitk-search/image/upload/v" + result[0].version + "/user_photos/<?php echo $_SESSION['user'] ;?>" + "/<?php echo $data['images_uploaded']+1 ;?>.jpg");

            imageUpload(1,result[0].version);
          }
      );

      // function to change the image according to the one selected by user
      $("#upload_image2").cloudinary_upload_widget(
          {
            cloud_name: 'iitk-search', upload_preset: '<?php echo $uploadPreset ?>',
            cropping: 'server', folder: 'user_photos' ,
            sources:[ 'local', 'url', 'facebook', 'instagram'] , multiple:false,
            resource_type: 'image',
            client_allowed_formats: ["png", "jpeg", "jpg"],
            max_file_size: 200000,
            type:"private",
            public_id: "<?php echo $_SESSION['user'];?>/<?php echo ($data['images_uploaded']+1) ?>"
          },function(error, result)
            {
              $('.cloudinary-thumbnails').remove();
              $("#upload_image4").siblings('img').attr("src","https://res.cloudinary.com/iitk-search/image/upload/v" + result[0].version + "/user_photos/<?php echo $_SESSION['user'] ;?>" + "/<?php echo $data['images_uploaded']+1 ;?>.jpg");

              imageUpload(2,result[0].version);
            }
        );

        // function to change the image according to the one selected by user
        $("#upload_image3").cloudinary_upload_widget(
            {
              cloud_name: 'iitk-search', upload_preset: '<?php echo $uploadPreset ?>',
              cropping: 'server', folder: 'user_photos' ,
              sources:[ 'local', 'url', 'facebook', 'instagram'] , multiple:false,
              resource_type: 'image',
              client_allowed_formats: ["png", "jpeg", "jpg"],
              max_file_size: 200000,
              type:"private",
              public_id: "<?php echo $_SESSION['user'];?>/<?php echo ($data['images_uploaded']+1) ?>"
            },function(error, result)
              {
                $('.cloudinary-thumbnails').remove();
                $("#upload_image4").siblings('img').attr("src","https://res.cloudinary.com/iitk-search/image/upload/v" + result[0].version + "/user_photos/<?php echo $_SESSION['user'] ;?>" + "/<?php echo $data['images_uploaded']+1 ;?>.jpg");

                imageUpload(3,result[0].version);
              }
          );

          // function to change the image according to the one selected by user
          $("#upload_image4").cloudinary_upload_widget(
              {
                cloud_name: 'iitk-search', upload_preset: '<?php echo $uploadPreset ?>',
                cropping: 'server', folder: 'user_photos' ,
                sources:[ 'local', 'url', 'facebook', 'instagram'] , multiple:false,
                resource_type: 'image',
                client_allowed_formats: ["png", "jpeg", "jpg"],
                max_file_size: 200000,
                type:"private",
                public_id: "<?php echo $_SESSION['user'];?>/<?php echo ($data['images_uploaded']+1) ?>"
              },function(error, result)
                {
                  $('.cloudinary-thumbnails').remove();
                  $("#upload_image4").siblings('img').attr("src","https://res.cloudinary.com/iitk-search/image/upload/v" + result[0].version + "/user_photos/<?php echo $_SESSION['user'] ;?>" + "/<?php echo $data['images_uploaded']+1 ;?>.jpg");

                  imageUpload(4,result[0].version);
                }
            );

      });
  </script>

</body>
</html>
