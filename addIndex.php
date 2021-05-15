<?php
require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


if (isset($_POST['counter_num']) && isset($_POST['new_index'])) {

  $counter_num = $_POST['counter_num'];
  $new_index = $_POST['new_index'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);



  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }

  $sql = "SELECT * FROM counter WHERE counter_num='" . $counter_num . "'";

  if ($conn->query($sql)->fetch_assoc()) {

    if ($row["username"] === NULL) {
      $sql = "SELECT * FROM client WHERE username='" . $username . "'";

      $result = $conn->query($sql);

      if ($result->fetch_assoc()) {
        echo "3";
      } else {
        $sql = "SELECT * FROM client WHERE email='" . $email . "'";
        $result = $conn->query($sql);

        if ($result->fetch_assoc()) {
          echo "2";
        } else {
          $sql = "UPDATE client SET email='" . $email . "', username='" . $username . "', password='" . $hashed_password . "' WHERE code_client='" . $code_client . "'";

          if ($conn->query($sql) === TRUE) {
            echo "1";
          } else {
            echo "0";
          }
        }
      }
    } else {
      echo "4";
    }
  } else {
    echo "5";
  }
} else echo "6";
