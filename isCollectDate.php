<?php
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

$mounth = Date("m");
$day = Date("d");


$sql = "SELECT id FROM collect_date WHERE mounth = '" . $mounth . "' AND '" . $day . "' BETWEEN start_day - 1 AND end_day + 1 ";

if ($conn->query($sql)->fetch_assoc()) {
  echo "1";
} else {
  echo "0";
}
