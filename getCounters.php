<?php

require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


$heroes = array();

if (isset($_POST['code_client'])) {
  $code_client = $_POST['code_client'];

  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
  }
  $sql = "SELECT counter_num,address,old_index,status FROM counter INNER JOIN client ON counter.code_client = client.code_client WHERE client.code_client = '" . $code_client . "'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $stmt->bind_result($counter_num, $address, $old_index, $status);
  while ($stmt->fetch()) {

    //pushing fetched data in an array 
    $temp = [
      'counter_num' => $counter_num,
      'address' => $address,
      'old_index' => $old_index,
      'status' => $status
    ];

    //pushing the array inside the hero array 
    array_push($heroes, $temp);
  }
  echo json_encode($heroes);
} else {
  echo "All fields are required";
}
