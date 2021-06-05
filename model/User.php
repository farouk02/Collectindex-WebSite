<?php

require "DataBaseConfig.php";

class User
{
  public function __construct()
  {
  }

  public function add_user($firstname, $lastname, $username, $password)
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

    $stmt = $conn->prepare("INSERT INTO admin (firstname, lastname, username, password, is_admin) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $firstname, $lastname, $username, $password);

    return $stmt->execute();
  }

  public function del_user($id)
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

    $stmt = $conn->prepare("DELETE FROM admin WHERE id = ?");
    $stmt->bind_param("i", $id);

    return $stmt->execute();
  }

  public function up_user($firstname, $lastname, $username, $password, $id)
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

    $stmt = $conn->prepare("UPDATE admin SET firstname=?, lastname=?, username=?, password=? WHERE id=?");

    $stmt->bind_param("sssss", $firstname, $lastname, $username, $password, $id);

    return $stmt->execute();
  }
}
