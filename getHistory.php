<?php

require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbc->servername;
$dbusername = $dbc->username;
$dbpassword = $dbc->password;
$dbname = $dbc->databasename;


$heroes = array();

if (isset($_GET['counter_num'])) {
  $counter_num = $_GET['counter_num'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }

  $sql = "SELECT new_index,date FROM collect INNER JOIN counter ON collect.num_counter = counter.num_counter WHERE collect.num_counter = '" . $counter_num . "'";
  $stmt = $conn->prepare($sql);
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
