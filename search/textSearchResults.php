    <div class="row">
      <button id="numResults" type="button" name="button">{{resultsNumber}} results found</button>
    </div>

  <div id="resulting" buffered-scroll="increaseLimit();" ng-init="limit=15;">
    <div class="row" id="resultsShow" ng-repeat="student in filteredResults | limitTo: limit">

      <div class="col l4 col m4 col s12 studentResult">
        <div class="card horizontal modal-trigger" data-target="resultModal">

          <div class="card-image">
            <img ng-src="{{ 'https://oa.cc.iitk.ac.in/Oa/Jsp/Photo/' + student[0]['i'] + '_0.jpg' }}" style="width:130px;height:160px">
          </div>

          <div class="card-stacked">
            <div class="card-content">
              <h5 class="name">{{student[0]['n']}}</h5>
              <ul>
                <li class="roll">{{student[0]['i']}}</li>
                <li class="dept">{{student[0]['d']}}</li>
                <li class="room" style="display:none">{{student[0]['r']}} , {{student[0]['h']}}</li>
                <li class="bloodGroup">{{student[0]['b']}}</li>
                <li class="mail">{{student[0]['u']}}@iitk.ac.in</li>
                <li class="address" style="display:none">{{student[0]['a']}}</li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <div class="col l4 col m4 col s12 studentResult">
        <div class="card horizontal modal-trigger" data-target="resultModal" ng-if="student[1]">

          <div class="card-image">
            <img ng-src="{{ 'https://oa.cc.iitk.ac.in/Oa/Jsp/Photo/' + student[1]['i'] + '_0.jpg' }}" style="width:130px;height:160px">
          </div>

          <div class="card-stacked">
            <div class="card-content">
              <h5 class="name">{{student[1]['n']}}</h5>
              <ul>
                <li class="roll">{{student[1]['i']}}</li>
                <li class="dept">{{student[1]['d']}}</li>
                <li class="room" style="display:none">{{student[1]['r']}} , {{student[1]['h']}}</li>
                <li class="bloodGroup">{{student[1]['b']}}</li>
                <li class="mail">{{student[1]['u']}}@iitk.ac.in</li>
                <li class="address" style="display:none">{{student[1]['a']}}</li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <div class="col s12 col l4 col m4 studentResult">
        <div class="card horizontal modal-trigger" data-target="resultModal" ng-if="student[2]">

          <div class="card-image">
            <img ng-src="{{ 'https://oa.cc.iitk.ac.in/Oa/Jsp/Photo/' + student[2]['i'] + '_0.jpg' }}" style="width:130px;height:160px">
          </div>

          <div class="card-stacked">
            <div class="card-content">
              <h5 class="name">{{student[2]['n']}}</h5>
              <ul>
                <li class="roll">{{student[2]['i']}}</li>
                <li class="dept">{{student[2]['d']}}</li>
                <li class="room" style="display:none">{{student[1]['r']}} , {{student[1]['h']}}</li>
                <li class="bloodGroup">{{student[2]['b']}}</li>
                <li class="mail">{{student[2]['u']}}@iitk.ac.in</li>
                <li class="address" style="display:none">{{student[2]['a']}}</li>
              </ul>
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

    // Initialization for Materialize
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('.modal').modal();

    $('select').change(function(){
      $('select').material_select();
    });

    $(document).on( "click",  ".card" , function(event) {
        var currCard = $(event.target).closest('.card');
        var name = currCard.find('.name').html();
        var roll = currCard.find('.roll').html();
        var dept = currCard.find('.dept').html();
        var room = currCard.find('.room').html();
        var mail = currCard.find('.mail').html();
        var bloodGroup = currCard.find('.bloodGroup').html();
        var address = currCard.find('.address').html();
        var src = currCard.find('img').attr('src');

        $('#resultModal').find('.name').html(name);
        $('#resultModal').find('.dept').html("<b>Department: </b>" + dept);
        $('#resultModal').find('.roll').html("<b>Roll No.: </b>" + roll);
        $('#resultModal').find('.room').html("<b>Room: </b>" + room);
        $('#resultModal').find('.bloodGroup').html("<b>Blood Group: </b>" + bloodGroup);
        $('#resultModal').find('.address').html("<b>Address: </b>" + address);
        $('#resultModal').find('.mail').html("<b>IITK mail: </b>" + mail);
        $('#resultModal').find('img').attr('src',src);
    });
  });

</script>
