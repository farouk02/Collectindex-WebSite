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


$heroes = array();

$sql = "SELECT start_date,end_date FROM collect_date";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($start_date, $end_date);



while ($stmt->fetch()) {

  //pushing fetched data in an array 
  $temp = [
    'start_date' => $start_date,
    'end_date' => $end_date
  ];

  //pushing the array inside the hero array 
  array_push($heroes, $temp);
}
echo json_encode($heroes);
