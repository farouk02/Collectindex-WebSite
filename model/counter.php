<?php

require "DataBaseConfig.php";

class Counter
{
  public $counter_num;
  public $address;
  public $old_index;
  public $status;

  public function __construct($counter_num, $address, $old_index, $status)
  {
    $this->counter_num = $counter_num;
    $this->address = $address;
    $this->old_index = $old_index;
    $this->status = $status;
  }

  public function add_counter($counter_num, $address, $old_index, $status)
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

    $stmt = $conn->prepare("INSERT INTO counter (counter_num, address, old_index, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $counter_num, $address, $old_index, $status);

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

  public function up_counter($oldCounter, $counter_num, $address, $old_index, $status)
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

    $stmt = $conn->prepare("UPDATE client SET counter_num = ?, address = ?, old_index = ?, status = ? WHERE counter_num = ?");
    $stmt->bind_param("ssss", $codeClient, $firstname, $lastname, $oldClient);

    return $stmt->execute();
  }
}
