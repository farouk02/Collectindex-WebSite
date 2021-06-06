<?php
include "view/header.php";
if ($isAdmin) :
  require "model/Period.php";

  $p = new Period();
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
      if ($p->del_period($_POST["dis_code_client"])) {
        echo '<div class="alert alert-success">';
        echo '<strong>Bien fait!</strong> Vous avez réussi à supprimer la période.';
        echo '</div>';
      }
    }
  }
  if (isset($_POST["addButton"])) {
    if (!empty($_POST['add_mounth']) && !empty($_POST['add_start_date']) && !empty($_POST['add_end_date'])) {
      if ($_POST['add_start_date'] < $_POST['add_end_date']) {
        if ($p->add_period($_POST['add_mounth'], $_POST['add_start_date'], $_POST['add_end_date'])) {
          echo '<div class="alert alert-success">';
          echo '<strong>Bien fait!</strong> Vous avez ajouté avec succès une période.';
          echo '</div>';
        }
      } else {
        echo '<div class="alert alert-danger">';
        echo '<strong>Mal!</strong> Vous avez ajouté avec succès une période.';
        echo '</div>';
      }
    }
  }
  if (isset($_POST["upButton"])) {
    if (isset($_POST['dis_up_code_client']) && isset($_POST['mounth']) && isset($_POST['start_date']) && isset($_POST['end_date'])) {

      if ($_POST['start_date'] < $_POST['end_date']) {
        if ($p->up_period($_POST['mounth'], $_POST['start_date'], $_POST['end_date'], $_POST["dis_up_code_client"])) {
          echo '<div class="alert alert-success">';
          echo '<strong>Bien fait!</strong> start_date ne peut pas superieur a end_date.';
          echo '</div>';
        }
      } else {
        echo '<div class="alert alert-danger">';
        echo '<strong>Mal!</strong> start_date superieur a end_date.';
        echo '</div>';
      }
    }
  }


?>


  <div class="header">
    <h1 class="page-header">
      Les Périodes <small>List des Périodes</small>
    </h1>
  </div>
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
          <div class="panel-heading">Périodes</div>
          <div class="panel-body">
            <div id="add_client_button" style="margin-bottom: 10px; display: flex; flex-direction: row-reverse;">
              <button class="btn btn-primary " data-toggle="modal" data-target="#addModal">Ajouter Utilisateur</button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Mois</th>
                    <th>Période ( jours )</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT id,mounth,start_day,end_day FROM collect_date";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $stmt->bind_result($id, $mounth, $start_day, $end_day);

                  $i = 1;
                  while ($stmt->fetch()) {
                    echo '<tr class="odd gradeX">';
                    echo '<td class="center">' . $i++ . '</td>';
                    echo '<td class="center">' . $mounth . '</td>';
                    echo '<td class="center"><strong>' . $start_day . '</strong> vers <strong>' . $end_day . '</strong></td>';
                    echo '<td class="center">';
                    echo '<button onClick="upM(this)" class="btn btn-warning btn-sm" data-toggle="modal" data="' . $id . '" mounth="' . $mounth . '" start_day="' . $start_day . '" end_day="' . $end_day . '">Modifier</button> ';
                    echo '<button onClick="delM(this)" class="btn btn-danger btn-sm" data-toggle="modal" data="' . $id . '">Supprimer</button>';
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
              Modifier la période
            </h4>
          </div>
          <div class="modal-body">
            <input class="form-control" name="dis_up_code_client" id="disUpCodeClient" type="text" style="display: none;" />
            <div class="form-group">
              <label>Mois de la collection</label>
              <select name="mounth" id="mounth" data-live-search="true" class="form-control">
                <option value="1">01 - Janvier</option>
                <option value="2">02 - Février</option>
                <option value="3">03 - Mars</option>
                <option value="4">04 - Avril</option>
                <option value="5">05 - Mai</option>
                <option value="6">06 - Juin</option>
                <option value="7">07 - Juillet</option>
                <option value="8">08 - Août</option>
                <option value="9">09 - Septembre</option>
                <option value="10">10 - Octobre</option>
                <option value="11">11 - Novembre</option>
                <option value="12">12 - Décembre</option>
              </select>
            </div>
            <div class="form-group">
              <label>Début ( jour )</label>
              <input id="start_date" type="number" name="start_date" class="form-control" />
            </div>
            <div class="form-group">
              <label>Fin ( jour )</label>
              <input id="end_date" type="number" name="end_date" class="form-control" />
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
                <label for="dis_code_client">Vous voulez supprimer cette période?</label>
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
              Ajouter la période
            </h4>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="add_mounth">Mois de la collection</label>
              <select name="add_mounth" class="form-control">
                <option value="1">01 - Janvier</option>
                <option value="2">02 - Février</option>
                <option value="3">03 - Mars</option>
                <option value="4">04 - Avril</option>
                <option value="5">05 - Mai</option>
                <option value="6">06 - Juin</option>
                <option value="7">07 - Juillet</option>
                <option value="8">08 - Août</option>
                <option value="9">09 - Septembre</option>
                <option value="10">10 - Octobre</option>
                <option value="11">11 - Novembre</option>
                <option value="12">12 - Décembre</option>
              </select>
            </div>
            <div class="form-group">
              <label>Début ( jour )</label>
              <input type="number" name="add_start_date" class="form-control" />
            </div>
            <div class="form-group">
              <label>Fin ( jour )</label>
              <input type="number" name="add_end_date" class="form-control" />
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