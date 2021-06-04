<?php

require "DataBaseConfig.php";

class Client
{
  public $codeClient;
  public $firstname;
  public $lastname;
  public $email;
  public $username;
  public $password;
  public function __construct()
  {
  }

  public function add_client($codeClient, $firstname, $lastname)
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

    $stmt = $conn->prepare("INSERT INTO client (code_client, firstname, lastname) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $codeClient, $firstname, $lastname);

    return $stmt->execute();
  }

  public function del_client($codeClient)
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

    $stmt = $conn->prepare("DELETE FROM client WHERE code_client = ?");
    $stmt->bind_param("s", $codeClient);

    return $stmt->execute();
  }
  public function up_client($codeClient, $firstname, $lastname, $oldClient)
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

    $stmt = $conn->prepare("UPDATE client SET code_client = ?, firstname = ?, lastname = ? WHERE code_client = ?");
    $stmt->bind_param("ssss", $codeClient, $firstname, $lastname, $oldClient);

    return $stmt->execute();
  }
}
