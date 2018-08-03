<?php
  session_start();

  include_once '../includes/checkSetCookie.inc.php';

  if(isset($_SESSION['user']))
  {
    include_once 'login_header.php';
    $user = $_SESSION['user'];
  }
  else
  {
    header("Location: ../index.php");
    exit();
  }
?>

<!-- Including angular library -->
<script type="text/javascript" src="../includes/angular/angular.min.js"></script>
<script type="text/javascript" src="scripts/textSearchModule.js"></script>

<div ng-app="text-search">
  <div ng-controller="textSearchController">
      <div class="row">
        <div class="col s12 col l8 col offset-l2 col m8 col offset-m2">
          <br><br>
          <h5><u>Text-Based Search</u></h5>
          <br>
          <div class="textForm">
            <div class="row">
              <br>
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="year" multiple class="choiceBox y">
                  <option selected disabled>Year</option>
                  <option value="Y18">Y18</option> 
                  <option value="Y17">Y17</option>
                  <option value="Y16">Y16</option>
                  <option value="Y15">Y15</option>
                  <option value="Y14">Y14</option>
                  <option value="Y13">Y13</option>
                  <option value="Y12">Y12</option>
                  <option value="Y11">Y11</option>
                  <option value="Y10">Y10</option>
                  <option value="others">Others</option>
                </select>
              </div>
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="gender" multiple class="choiceBox g">
                  <option selected disabled>Gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
              </div>
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="bloodGroup" multiple class="choiceBox b">
                  <option selected disabled>Blood Group</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>

            </div>

            <br>

            <div class="row">
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="programme" multiple class="choiceBox p">
                  <option selected disabled>Program</option>
                  <option value="BS">BS</option>
                  <option value="BS-MBA">BS-MBA</option>
                  <option value="BS-MS">BS-MS</option>
                  <option value="BS-MT">BS-MT</option>
                  <option value="BT-M.Des">BT-M.Des</option>
                  <option value="BT-MBA">BT-MBA</option>
                  <option value="BT-MS">BT-MS</option>
                  <option value="BTech">BTech</option>
                  <option value="Exchng Prog.">Exchng Prog.</option>
                  <option value="MBA">MBA</option>
                  <option value="MDes">MDes</option>
                  <option value="MS-Research">MS-Research</option>
                  <option value="MSc(2 yr)">MSc(2 yr)</option>
                  <option value="MSc(Int)">MSc(Int)</option>
                  <option value="MT(Dual)">MT(dual)</option>
                  <option value="MTech">MTech</option>
                  <option value="PGPEX-VLM">PGPEX-VLM</option>
                  <option value="PhD">PhD</option>
                  <option value="PhD(Dual)">PhD(Dua)</option>
                  <option value="Prep.">Prep.</option>
                  <option value="SURGE">SURGE</option>
                </select>
              </div>
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="department" multiple class="choiceBox d">
                  <option selected disabled>Departments</option>
                  <option value="Aerospace Engg.">Aerospace</option>
                  <option value="Biol.Sci. And Bio.Engg.">BSBE</option>
                  <option value="Chemical Engg.">Chemical</option>
                  <option value="Chemistry">Chemistry</option>
                  <option value="Civil Engg.">Civil</option>
                  <option value="Computer Science \u0026 Engg.">Computer Science</option>
                  <option value="Earth Sciences">Earth Sciences</option>
                  <option value="Economics">Economics</option>
                  <option value="Electrical Engg.">Electrical</option>
                  <option value="Materials Science \u0026 Engg.">Material Science</option>
                  <option value="Mathematics">Mathematics</option>
                  <option value="Mechanical Engineering">Mechanical</option>
                  <option value="Physics">Physics</option>
                  <option value="Cognitive Sciences">Cognitive Sciences</option>
                  <option value="Environmental Engg. \u0026 Mgmt">Environmental Engg. and MGMT</option>
                  <option value="Humanities \u0026 Soc. Sciences">Humanities</option>
                  <option value="Ind. \u0026 Management Engg.">Industrial and Management Engg.</option>
                  <option value="Laser Technology">Laser Technology</option>
                  <option value="Master Of Design">Master of Design</option>
                  <option value="Math For Pg Online">Math for PG online</option>
                  <option value="Nuc. Engg.\u0026 Tech Prog.">Nuclear Engg.</option>
                  <option value="Photonics Science \u0026 Engg.">Photonics</option>
                  <option value="Statistics">Statistics</option>
                </select>
              </div>
              <div class="input-field col s12 col l4 col m4">
                <select ng-model="hall" multiple class="choiceBox h">
                  <option selected disabled>Halls</option>
                  <option value="GH">GH</option>
                  <option value="HALL1">Hall 1</option>
                  <option value="HALL2">Hall 2</option>
                  <option value="HALL3">Hall 3</option>
                  <option value="HALL4">Hall 4</option>
                  <option value="HALL5">Hall 5</option>
                  <option value="HALL6">Hall 6</option>
                  <option value="HALL7">Hall 7</option>
                  <option value="HALL8">Hall 8</option>
                  <option value="HALL9">Hall 9</option>
                  <option value="HALLX">Hall 10</option>
                  <option value="HALLXI">Hall 11</option>
                  <option value="HALL12">Hall 12</option>
                  <option value="HALL13">Hall 13</option>
                  <option value="SBRA">SBRA</option>
                  <option value="DAY">DAY</option>
                  <option value="SBRA">ACES</option>
                  <option value="SBRA">TYPE5</option>
                  <option value="NRA">NRA</option>
                  <option value="RA">RA</option>
                  <option value="TYPE1B">TYPE1B</option>
                  <option value="CPWD">CPWD</option>
                  <option value="TYPE1">TYPE1</option>
                </select>
              </div>

            </div>

            <div class="row inpText">
              <div class="input-field col s12 col l12">
                <input ng-model="rawInput" id="inpSearch" type="text" class="validate">
                <label for="inpSearch">Name/Roll No./Username</label>
                <i class="material-icons">search</i>
              </div>
            </div>

          </div>
        </div>


      </div>

    <!-- Results logic and display -->
    <?php include_once 'textSearchResults.php'; ?>
    <!-- end of results -->
  </div>
</div> <!-- End of ng-app -->

</body>
</html>
