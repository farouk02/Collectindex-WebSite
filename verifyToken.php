<?php
session_start();
require "DataBaseConfig.php";
$dbC = new DataBaseConfig();


$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_errno) {
  die("connection faild: " . $conn->connect_errno);
}




if (isset($_GET['token'])) {
  $token = $_GET['token'];

  $sql = "SELECT * FROM client WHERE token='" . $token . "'";

  $result = $conn->query($sql);
  if ($result->fetch_assoc()) {
    $sql = "UPDATE client SET verified = true WHERE token='" . $token . "'";
    if ($conn->query($sql) === TRUE) {
      echo '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Your email has been verified.</br>You can now return to the application and complete the operation.</p>
      </div>
    </body>

    </html>' . "";
    } else {
      echo "Please verify later!";
    }
  } else {
    echo "User not found!";
  }
} else {
  echo "No token provided!";
}
