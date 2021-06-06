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
  $old_index = $_POST['old_index'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);



  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }

  $sql = "SELECT * FROM counter WHERE counter_num='" . $counter_num . "'";

  if ($conn->query($sql)->fetch_assoc()) {
    $date = date('Y/m/d');

    $sql = "SELECT id,date FROM collect WHERE counter_num='" . $counter_num . "' LIMIT 1";

    if ($row = $conn->query($sql)->fetch_assoc()) {

      $id = $row['id'];
      $old_date = strtotime($row['date']);

      $old_date_m = date('m', $old_date);
      $old_date_d = date('d', $old_date);

      $mounth = Date("m");
      $day = Date("d");

      $sql = "SELECT mounth,start_day,end_day FROM collect_date WHERE mounth = '" . $mounth . "' AND '" . $day . "' BETWEEN start_day - 1 AND end_day + 1 ";

      if ($row = $conn->query($sql)->fetch_assoc()) {
        $mounth = $row['mounth'];
        $start_day = $row['start_day'];
        $end_day = $row['end_day'];

        if (($old_date_m == $mounth) && ($old_date_d >= $start_day && $old_date_d <= $end_day)) {
          $sql = "UPDATE `collect` SET new_index=" . $old_index . ", date='" . $date . "' WHERE id='" . $id . "'";
        } else {
          $sql = "INSERT INTO `collect` (counter_num, new_index, date) VALUES ('" . $counter_num . "', " . $old_index . ", '" . $date . "')";
        }
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
      }
    }
  } else {
    echo "2";
  }
} else echo "3";
