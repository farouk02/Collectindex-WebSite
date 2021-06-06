<?php
require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


if (isset($_POST['counter_num']) && isset($_POST['new_index']) && isset($_POST['old_index'])) {

  $counter_num = $_POST['counter_num'];
  $new_index = $_POST['new_index'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);



  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }

  $sql = "SELECT * FROM counter WHERE counter_num='" . $counter_num . "'";

  if ($conn->query($sql)->fetch_assoc()) {
    $date = date('Y/m/d');
    $sql = "INSERT INTO `collect` (counter_num, new_index, date) VALUES ('" . $counter_num . "', " . $new_index . ", '" . $date . "')";

    if ($conn->query($sql) === TRUE) {
      $sql = "UPDATE counter SET old_index='" . $new_index . "' WHERE counter_num='" . $counter_num . "'";

      if ($conn->query($sql) === TRUE) {
        echo "1";
      } else {
        echo "-1";
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    echo "2";
  }
} else echo "3";
