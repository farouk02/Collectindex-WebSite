<?php

require "DataBaseConfig.php";

class Period
{
  public function __construct()
  {
  }

  public function add_period($mounth, $start_day, $end_day)
  {

    $dbC = new DataBaseConfig();
    $servername = $dbC->servername;
    $dbusername = $dbC->username;
    $dbpassword = $dbC->password;
    $dbname = $dbC->databasename;

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_errno) {
      ("connection faild: " . $conn->connect_errno);
    }

    $stmt = $conn->prepare("INSERT INTO collect_date (mounth, start_day, end_day) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $mounth, $start_day, $end_day);

    return $stmt->execute();
  }

  public function del_period($id)
  {

    $dbC = new DataBaseConfig();
    $servername = $dbC->servername;
    $dbusername = $dbC->username;
    $dbpassword = $dbC->password;
    $dbname = $dbC->databasename;

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_errno) {
      ("connection faild: " . $conn->connect_errno);
    }

    $stmt = $conn->prepare("DELETE FROM collect_date WHERE id = ?");
    $stmt->bind_param("i", $id);

    return $stmt->execute();
  }

  public function up_period($mounth, $start_day, $end_day, $id)
  {

    $dbC = new DataBaseConfig();
    $servername = $dbC->servername;
    $dbusername = $dbC->username;
    $dbpassword = $dbC->password;
    $dbname = $dbC->databasename;

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_errno) {
      ("connection faild: " . $conn->connect_errno);
    }

    $stmt = $conn->prepare("UPDATE collect_date SET mounth=?, start_day=?, end_day=? WHERE id=?");

    $stmt->bind_param("iiii", $mounth, $start_day, $end_day, $id);

    return $stmt->execute();
  }
}
