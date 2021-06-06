<?php
include "view/header.php";
require "DataBaseConfig.php";

$dbC = new DataBaseConfig();
$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_errno) {
  ("connection faild: " . $conn->connect_errno);
}

?>

<div class="header">
  <h1 class="page-header">
    Dashboard <small>Summary of App</small>
  </h1>
</div>
<div id="page-inner">
  <!-- /. ROW  -->


  <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <!-- Display messages -->
      <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
          unset($_SESSION['type']);
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder blue">
        <div class="panel-left pull-left blue">
          <i class="fa fa-users fa-5x"></i>
        </div>
        <div class="panel-right">
          <?php
          echo '<h3>';
          $sql = 'SELECT null FROM client';
          $result = $conn->query($sql);
          echo $result->num_rows;
          echo '</h3>';
          ?>
          <strong>Total clients</strong>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder blue">
        <div class="panel-left pull-left blue">
          <i class="fa fa-users fa-5x"></i>
        </div>
        <div class="panel-right">
          <?php
          echo '<h3>';
          $sql = 'SELECT null FROM client WHERE username!=\'\'';
          $result = $conn->query($sql);
          echo $result->num_rows;
          echo '</h3>';
          ?>
          <strong>Clients abonnée</strong>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder blue">
        <div class="panel-left pull-left blue">
          <i class="fa fa-dashboard fa-5x"></i>
        </div>
        <div class="panel-right">
          <?php
          echo '<h3>';
          $sql = 'SELECT null FROM counter';
          $result = $conn->query($sql);
          echo $result->num_rows;
          echo '</h3>';
          ?>
          <strong>Total compteurs</strong>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder blue">
        <div class="panel-left pull-left blue">
          <i class="fa fa-desktop fa-5x"></i>
        </div>
        <div class="panel-right">
          <?php
          echo '<h3>';
          $sql = 'SELECT null FROM admin';
          $result = $conn->query($sql);
          echo $result->num_rows;
          echo '</h3>';
          ?>
          <strong>Total administrateurs</strong>
        </div>
      </div>
    </div>
  </div>
  <!-- /. ROW  -->


  <div class="row">
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="panel panel-default">
        <div class="panel-heading">Consultation</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Code client</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Num. Compteur</th>
                  <th>Ancien index</th>
                  <th>Nouvel index</th>
                  <th>Quantité</th>
                </tr>
              </thead>
              <tbody>

                <?php


                $sql = "SELECT client.code_client,firstname,lastname,username,counter.counter_num,status,old_index FROM counter INNER JOIN client ON counter.code_client = client.code_client";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($code_client, $firstname, $lastname, $username, $counter_num, $status, $new_index);

                $i = 1;
                while ($stmt->fetch()) {


                  $conn2 = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                  $sql = "SELECT new_index,date FROM collect INNER JOIN counter ON collect.counter_num = counter.counter_num AND collect.counter_num=? limit 1";
                  $stmt2 = $conn2->prepare($sql);
                  $stmt2->bind_param("s", $counter_num);
                  $stmt2->execute();
                  $stmt2->bind_result($old_index, $date);
                  if ($stmt2->fetch())

                    if ($username && $status = 1) {
                      echo '<tr class="odd gradeX' . (($new_index - $old_index < 10) ? ' danger' : '') . '">';
                      echo '<td class="center">' . $i++ . '</td>';
                      echo '<td class="center">' . $code_client . '</td>';
                      echo '<td class="center">' . $firstname . '</td>';
                      echo '<td class="center">' . $lastname . '</td>';
                      echo '<td class="center">' . $counter_num . '</td>';

                      $old_date_m = date('m', strtotime($date));
                      $mounth = Date("m");

                      $conn3 = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                      $sql = 'SELECT mounth FROM collect_date WHERE mounth BETWEEN ' . $old_date_m . ' AND ' . $mounth;
                      $result = $conn3->query($sql);

                      if ($result->num_rows === 1) {
                        echo '<td class="center">' . $old_index . '</br><small>' . $date . '</small></td>';
                        echo '<td class="center">' . $new_index . '</td>';
                        echo '<td class="center">' .  $new_index - $old_index . '</td>';
                      } else {
                        echo '<td class="center warning">' . $new_index . '</br><small>' . $date . '</small></td>';
                        echo '<td class="center warning"></td>';
                        echo '<td class="center warning">-</td>';
                      }
                      echo '</tr>';
                    }
                }

                ?>


              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--End Advanced Tables -->
    </div>
  </div>

  <!-- /. ROW  -->

  <footer>
    <p>
      All right reserved. Template by:
      <a href="http://localhost.com">ADE - Collect</a>
    </p>
  </footer>
</div>
<!-- /. PAGE INNER  -->
<?php
include "view/footer.php";
?>