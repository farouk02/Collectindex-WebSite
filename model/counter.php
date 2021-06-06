<?php
require "DataBaseConfig.php";

class Counter
{
  public function __construct()
  {
  }

  public function add_counter($counter_num, $code_client, $address, $old_index, $status)
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

    $stmt = $conn->prepare("INSERT INTO counter (counter_num,code_client,address,old_index,status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $counter_num, $code_client, $address, $old_index, $status);

    return $stmt->execute();
  }

  public function del_counter($counter_num)
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

    $stmt = $conn->prepare("DELETE FROM counter WHERE counter_num = ?");
    $stmt->bind_param("s", $counter_num);

    return $stmt->execute();
  }

  public function up_counter($counter_num, $code_client, $address, $old_index, $status, $oldCounter)
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

    $stmt = $conn->prepare("UPDATE counter SET counter_num=?,code_client=?,address=?,old_index=?,status=? WHERE counter_num=?");
    $stmt->bind_param("sssiis", $counter_num, $code_client, $address, $old_index, $status, $oldCounter);

    return $stmt->execute();
  }
}
