<?php
include "view/header.php";
require "model/Client.php";

$c = new Client();
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
    if ($c->del_client($_POST["dis_code_client"])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Well done!</strong> You successfully read this important alert message.';
      echo '</div>';
    }
  }
}
if (isset($_POST["addButton"])) {
  if (isset($_POST['add_code_client']) && isset($_POST['add_firstname']) && isset($_POST['add_lastname'])) {
    $c->add_client($_POST['add_code_client'], $_POST['add_firstname'], $_POST['add_lastname']);
  }
}
if (isset($_POST["upButton"])) {
  if (isset($_POST['dis_up_code_client']) && isset($_POST['code_client']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
    $c->up_client($_POST['code_client'], $_POST['firstname'], $_POST['lastname'], $_POST["dis_up_code_client"]);
  }
}

$isAdmin = ($_SESSION['is_admin'] === "1") ? true : false;

?>

<div class="header">
  <h1 class="page-header">
    Les Clients <small>List des clients</small>
  </h1>
</div>

<div id="page-inner">
  <div class="row">
    <div class="col-md-12">
      <!-- Advanced Tables -->
      <div class="panel panel-default">
        <div class="panel-heading">Clients</div>
        <div class="panel-body">
          <div id="add_client_button" style="margin-bottom: 10px; display: flex; flex-direction: row-reverse;">
            <button class="btn btn-primary " data-toggle="modal" data-target="#addModal">Ajouter Client</button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Code client</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>inscrive</th>
                  <?php
                  if ($isAdmin) {
                    echo '<th>Email</th>';
                    echo '<th>Username</th>';
                  }
                  ?>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = "SELECT code_client,firstname,lastname,email,username FROM client";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($code_client, $firstname, $lastname, $email, $username);

                $i = 1;
                while ($stmt->fetch()) {
                  echo '<tr class="odd gradeX">';
                  echo '<td class="center">' . $i++ . '</td>';
                  echo '<td class="center">' . $code_client . '</td>';
                  echo '<td class="center">' . $firstname . '</td>';
                  echo '<td class="center">' . $lastname . '</td>';
                  echo '<th>' . (($email === null || $username === null) ? 'NON' : 'OUI') . '</th>';

                  if ($isAdmin) {
                    echo '<th>' . $email . '</th>';
                    echo '<th>' . $username . '</th>';
                  }

                  echo '<td class="center">
                    <button onClick="upM(this)" class="btn btn-warning btn-sm" data-toggle="modal" data="' . $code_client . '">Modifier</button>
                    <button onClick="delM(this)" class="btn btn-danger btn-sm" data-toggle="modal" data="' . $code_client . '">Supprimer</button>
                  </td>';
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
            <label for="code_client">Code client</label>
            <input id="upCodeClient" name="code_client" type="text" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="firstname">Nom</label>
            <input name="firstname" type="firstname" class="form-control" required />
          </div>
          <div class="form-group">
            <label for="lastname">Prenom</label>
            <input name="lastname" type="lastname" class="form-control" required />
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
              <label for="dis_code_client">Vous voulez supprimer cette client?</label>
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
            Ajouter un client
          </h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Code client</label>
            <input name="add_code_client" class="form-control" />
          </div>
          <div class="form-group">
            <label>Nom</label>
            <input name="add_firstname" class="form-control" />
          </div>
          <div class="form-group">
            <label>Prenom</label>
            <input name="add_lastname" class="form-control" />
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
include "view/footer.php";
?>