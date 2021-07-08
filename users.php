<?php
include "view/header.php";
require "model/User.php";

$u = new User();
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
    if ($u->del_user($_POST["dis_code_client"])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez réussi à supprimer l\'utilisateur.';
      echo '</div>';
    }
  }
}
if (isset($_POST["addButton"])) {
  if (isset($_POST['add_firstname']) && isset($_POST['add_lastname']) && isset($_POST['add_username']) && isset($_POST['add_password'])) {
    if ($u->add_user($_POST['add_firstname'], $_POST['add_lastname'], $_POST['add_username'], $_POST['add_password'])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez ajouté avec succès un nouvel utilisateur.';
      echo '</div>';
    }
  }
}
if (isset($_POST["upButton"])) {
  if (isset($_POST['dis_up_code_client']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password'])) {
    if ($u->up_user($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'],  $_POST["dis_up_code_client"])) {
      echo '<div class="alert alert-success">';
      echo '<strong>Bien fait!</strong> Vous avez réussi à mettre à jour l\'utilisateur.';
      echo '</div>';
    }
  }
}


?>

<?php if ($isAdmin) : ?>

  <div class="header">
    <h1 class="page-header">
      Les Utilisateurs <small>List des utilisateurs</small>
    </h1>
  </div>
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
          <div class="panel-heading">Utilisateurs</div>
          <div class="panel-body">
            <div id="add_client_button" style="margin-bottom: 10px; display: flex; flex-direction: row-reverse;">
              <button class="btn btn-primary " data-toggle="modal" data-target="#addModal">Ajouter Utilisateur</button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Admin</th>
                    <th>Username</th>
                    <th>password</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT id,firstname,lastname,is_admin,username,password FROM admin";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $stmt->bind_result($id, $firstname, $lastname, $is_admin, $username, $password);

                  $i = 0;
                  while ($stmt->fetch()) {
                    echo '<tr class=" ' . (($i % 2 === 0) ? 'even' : 'odd') . ' ">';
                    echo '<td class="center">' . ++$i . '</td>';
                    echo '<td class="center">' . $firstname . '</td>';
                    echo '<td class="center">' . $lastname . '</td>';
                    echo '<td>' . ((!$is_admin) ? 'USER' : 'ADMIN') . '</td>';
                    echo '<td>' . ((!$is_admin) ? $username : 'NO_ACCESS') . '</td>';
                    echo '<td>' . ((!$is_admin) ? $password : 'NO_ACCESS') . '</td>';
                    echo '<td class="center">';
                    if (!$is_admin) {
                      echo '<button onClick="upM(this)" class="btn btn-warning btn-sm" data-toggle="modal" data="' . $id . '" firstname="' . $firstname . '" lastname="' . $lastname . '" username="' . $username . '" password="' . $password . '"">Modifier</button> ';
                      echo '<button onClick="delM(this)" class="btn btn-danger btn-sm" data-toggle="modal" data="' . $id . '">Supprimer</button>';
                    }
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
        <form role="form" action="" method="post">
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
              <label for="firstname">Nom</label>
              <input id="firstname" name="firstname" type="firstname" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="lastname">Prenom</label>
              <input id="lastname" name="lastname" type="lastname" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="username">username</label>
              <input id="username" name="username" type="username" class="form-control" required />
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input id="password" name="password" type="text" class="form-control" required />
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
        <form role="form" action="" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              <div class="form-group">
                <label for="dis_code_client">Vous voulez supprimer cette utilisateur?</label>
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
        <form role="form" action="" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Ajouter un utilisateur
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nom</label>
              <input name="add_firstname" class="form-control" />
            </div>
            <div class="form-group">
              <label>Prenom</label>
              <input name="add_lastname" class="form-control" />
            </div>
            <div class="form-group">
              <label>username</label>
              <input type="username" name="add_username" class="form-control" />
            </div>
            <div class="form-group">
              <label>password</label>
              <input type="password" name="add_password" class="form-control" />
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