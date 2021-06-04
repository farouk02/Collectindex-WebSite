<?php

session_start();

require "DataBaseConfig.php";

$dbC = new DataBaseConfig();
$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


if (isset($_POST['login_bu'])) {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_errno) {
      ("connection faild: " . $conn->connect_errno);
    }

    $sql = "SELECT * FROM admin WHERE username='" . $username . "' AND password='" . $password . "' LIMIT 1";

    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
      $_SESSION['id'] = $row['id'];
      $_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
      $_SESSION['is_admin'] = $row['is_admin'];
      header('location: index.php');
      exit(0);
    } else {
      echo "Wrong username  password";
    }
  } else {
    echo "Required username and password";
  }
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">

  <title>ADE - Login</title>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login">
        <h3 class="text-center form-title">Login</h3>

        <form action="" role="form" method="post">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control form-control-lg">
          </div>
          <div class=" form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="login_bu" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script src="script.js"></script>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- Bootstrap Js -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Metis Menu Js -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<script src="assets/js/morris/raphael-2.1.0.min.js"></script>
<script src="assets/js/morris/morris.js"></script>

<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>

<script src="assets/js/Lightweight-Chart/jquery.chart.js"></script>

<!-- Custom Js -->
<script src="assets/js/custom-scripts.js"></script>

</html>