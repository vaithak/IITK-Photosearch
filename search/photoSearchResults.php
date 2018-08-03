<!-- Including angular library -->
<script type="text/javascript" src="../includes/angular/angular.min.js"></script>
<script type="text/javascript" src="scripts/photoSearchModule.js"></script>

<div ng-app="photo-search">
  <div id="printResults" ng-controller="photoSearchController">
    <br>

    <div class="row">
      <button id="numResultsPhoto" type="button" name="button">{{resultsNumber}} possible results found</button>
      <p style="text-align:center">Results may take some time.</p>
    </div>

    <br>

    <!-- <p>{{check}}</p> -->
    <!-- display search results -->
    <div class="row" id="resultsShow" ng-repeat="student in filteredResults">
      <div class="col s12 col l10 col m10 col offset-l2 col offset-m2 studentResult">
        <div class="card horizontal modal-trigger" data-target="resultModal">

          <div class="card-image">
            <img ng-src="{{ 'https://oa.cc.iitk.ac.in/Oa/Jsp/Photo/' + student['i'] + '_0.jpg' }}" style="height:180px">
          </div>

          <div class="card-stacked">
            <div class="card-content">
              <h5 class="name">{{student['n']}}</h5>
              <ul>
                <li class="roll"><b>Roll No.</b>: <i>{{student['i']}}<i></li>
                <li class="dept"><b>Department</b>: <i>{{student['d']}}<i></li>
                <li class="room" style="display:none"><b>Room</b>: <i>{{student['r']}} , {{student['h']}}</i></li>
                <li class="bloodGroup"><b>Blood Group</b>: <i>{{student['b']}}</i></li>
                <li class="mail"><b>IITK-mail</b>: <i>{{student['u']}}@iitk.ac.in</i></li>
                <li class="address" style="display:none"><b>Address</b>: <i>{{student['a']}}</i></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<?php
  include_once 'resultModal.html';
?>


<script type="text/javascript">

  $(document).ready(function(){
    $(".button-collapse").sideNav();
    $('.modal').modal();

    var canvas = document.getElementById("myCanvas");
    var ctx = canvas.getContext("2d");
    var img = document.getElementById("search-image");

    img.src = "../assets/person.jpg";
    img.onload = function(){
      ctx.drawImage(img,0,0,canvas.width,canvas.height);
    };

    // function to change the image according to the one selected by user
    $("#imgInp").change(function(event){
      event.preventDefault();
      var input = this;

      if (input.files && input.files[0])
      {
        var imageData;
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        reader.onloadend = function (e)
        {
          imageData = String(reader.result);
          $('#search-image').attr('src', e.target.result);
          img.src= e.target.result;
          img.onload = function(){
            ctx.drawImage(img,0,0,canvas.width,canvas.height);
          };

          var imgObj = {
            "image":imageData,
            "gallery_name":"photosearch_fin2",
            "threshold":"0.65"
          }
          var data = {"process":"recognize"};
          data.imgObj = JSON.stringify(imgObj);

          angular.element(document.getElementById('printResults')).scope().getImageResults(data);

        }
      }
    });

    // For resultModal
    $(document).on( "click",  ".card" , function(event) {
        var currCard = $(event.target).closest('.card');
        var name = currCard.find('.name').find('i').html();
        var roll = currCard.find('.roll').find('i').html();
        var dept = currCard.find('.dept').find('i').html();
        var room = currCard.find('.room').find('i').html();
        var mail = currCard.find('.mail').find('i').html();
        var bloodGroup = currCard.find('.bloodGroup').find('i').html();
        var address = currCard.find('.address').find('i').html();
        var src = currCard.find('img').attr('src');

        $('#resultModal').find('.name').html(name);
        $('#resultModal').find('.dept').html("<b>Department:</b>" + dept);
        $('#resultModal').find('.roll').html("<b>Roll No.:</b>" + roll);
        $('#resultModal').find('.room').html("<b>Room:</b>" + room);
        $('#resultModal').find('.bloodGroup').html("<b>Blood Group:</b>" + bloodGroup);
        $('#resultModal').find('.address').html("<b>Address:</b>" + address);
        $('#resultModal').find('.mail').html("<b>IITK mail:</b>" + mail);
        $('#resultModal').find('img').attr('src',src);
    })

  });

</script>
