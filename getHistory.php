<?php

require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


$heroes = array();

if (isset($_POST['counter_num'])) {
  $counter_num = $_POST['counter_num'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }

  $sql = "SELECT new_index,date FROM collect INNER JOIN counter ON collect.counter_num = counter.counter_num WHERE collect.counter_num = ? ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $counter_num);
  $stmt->execute();
  $stmt->bind_result($new_index, $date);



  while ($stmt->fetch()) {

    //pushing fetched data in an array 
    $temp = [
      'new_index' => $new_index,
      'date' => $date
    ];

    //pushing the array inside the hero array 
    array_push($heroes, $temp);
  }
  echo json_encode($heroes);
} else {
  echo "All fields are required";
}
