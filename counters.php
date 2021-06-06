<?php
include "view/header.php";
require "model/Counter.php";

$isAdmin = ($_SESSION['is_admin'] === "1") ? true : false;



$u = new Counter();
$dbC = new DataBaseConfig();
$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_errno) {
  ("connection faild: " . $conn->connect_errno);
}

if (isset($_POST["delButton"])) {
  if (isset($_POST['dis_code_client'])) {
    if ($u->del_counter($_POST["dis_code_client"])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez réussi à supprimer le compteur.';
      echo '</div>';
    }
  }
}
if (isset($_POST["addButton"])) {
  if (isset($_POST['add_counter_num']) && isset($_POST['add_firstname']) && isset($_POST['add_lastname']) && isset($_POST['add_username']) && isset($_POST['add_password'])) {
    if ($u->add_counter($_POST['add_counter_num'], $_POST['add_firstname'], $_POST['add_lastname'], $_POST['add_username'], $_POST['add_password'])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez ajouté avec succès un nouvel compteur.';
      echo '</div>';
    }
  }
}
if (isset($_POST["upButton"])) {
  if (isset($_POST['dis_up_code_client']) && isset($_POST['counter_num']) && isset($_POST['code_client']) && isset($_POST['address']) && isset($_POST['old_index']) && isset($_POST['status'])) {
    if ($u->up_counter($_POST['counter_num'], $_POST['code_client'], $_POST['address'], $_POST['old_index'], $_POST['status'],  $_POST["dis_up_code_client"])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez réussi à mettre à jour le compteur.';
      echo '</div>';
    }
  }
}


?>

<?php if ($isAdmin) : ?>

  <div class="header">
    <h1 class="page-header">
      Les Compteurs <small>List des compteurs</small>
    </h1>
  </div>
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
          <div class="panel-heading">Compteurs</div>
          <div class="panel-body">
            <div id="add_client_button" style="margin-bottom: 10px; display: flex; flex-direction: row-reverse;">
              <button class="btn btn-primary " data-toggle="modal" data-target="#addModal">Ajouter Compteurs</button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Propriétaire</th>
                    <th>Num Compteur</th>
                    <th>Address</th>
                    <th>Indice réel</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT counter_num,counter.code_client,client.firstname,client.lastname,address,old_index,status FROM counter INNER JOIN client ON counter.code_client=client.code_client ORDER BY code_client DESC";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $stmt->bind_result($counter_num, $code_client, $firstname, $lastname, $address, $old_index, $status);

                  $i = 1;
                  while ($stmt->fetch()) {
                    echo '<tr class="odd gradeX">';
                    echo '<td class="center">' . $i++ . '</td>';
                    echo '<td class="center">' . $code_client . '</br>' . $firstname . ' ' . $lastname . '</td>';
                    echo '<td class="center">' . $counter_num . '</td>';
                    echo '<td class="center">' . $address . '</td>';
                    echo '<th class="center">' . $old_index . '</th>';
                    echo '<td>' . ((!$status) ? 'BLOQUER' : 'EN MARCHE') . '</td>';
                    echo '<td class="center">';

                    echo '<button onClick="upM(this)" class="btn btn-warning btn-sm" data-toggle="modal" data="' . $counter_num . '" code_client="' . $code_client . '" address="' . $address . '" old_index="' . $old_index . '" status="' . $status . '"">Modifier</button> ';
                    echo '<button onClick="delM(this)" class="btn btn-danger btn-sm" data-toggle="modal" data="' . $counter_num . '">Supprimer</button>';

                    echo '</td>';
                    echo '</tr>';
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


  </div>
  <!-- /. ROW  -->
  <div class="modal fade" id="upModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Modifier le client
            </h4>
          </div>
          <div class="modal-body">
            <input class="form-control" name="dis_up_code_client" id="disUpCodeClient" type="text" style="display: none;" />
            <div class="form-group">
              <label for="code_client">Code Client</label>
              <input id="code_client" name="code_client" type="text" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="counter_num">counter_num</label>
              <input id="counter_num" name="counter_num" type="text" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="address">address</label>
              <input id="address" name="address" type="text" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="old_index">Indice réel</label>
              <input id="old_index" name="old_index" type="text" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Status : </label>
              <label class="radio-inline">
                <input type="radio" name="status" id="status1" value="1" />EN MARCHE
              </label>
              <label class="radio-inline">
                <input type="radio" name="status" id="status2" value="0" />BLOQUER
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Annuler
            </button>
            <button name="upButton" type="submit" class="btn btn-primary">
              Modifier
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              <div class="form-group">
                <label for="dis_code_client">Vous voulez supprimer cette compteur?</label>
                <input class="form-control" name="dis_code_client" id="disDelCodeClient" type="text" style="display: none;" />
              </div>
            </h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"=-09 +3-6*925>
              Annuler
            </button>
            <button name="delButton" type="submit" class="btn btn-primary">
              Supprimer
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Ajouter un compteur
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Code Client</label>
              <input type="id" name="add_firstname" class="form-control" />
            </div>
            <div class="form-group">
              <label>Num de Compteur</label>
              <input type="id" name="add_counter_num" class="form-control" />
            </div>
            <div class="form-group">
              <label>Address</label>
              <input name="add_lastname" class="form-control" />
            </div>
            <div class="form-group">
              <label>Indice réel</label>
              <input type="number" name="add_username" class="form-control" />
            </div>
            <div class="form-group">
              <label>Status : </label>
              <label class="radio-inline">
                <input type="radio" name="add_password" id="optionsRadiosInline1" value="1" checked="" />EN MARCHE
              </label>
              <label class="radio-inline">
                <input type="radio" name="add_password" id="optionsRadiosInline2" value="0" />BLOQUER
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"=-09 +3-6*925>
              Annuler
            </button>
            <button name="addButton" type="submit" class="btn btn-primary">
              Ajouter
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
endif;
include "view/footer.php";
?>