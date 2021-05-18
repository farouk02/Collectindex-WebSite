<?php
require "DataBaseConfig.php";
require_once "sendEmails.php";
$dbC = new DataBaseConfig();

session_start();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_errno) {
    die("connection faild: " . $conn->connect_errno);
}


if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE client SET verified = 0, token = null, password = '" . $hashed_password . "' WHERE email='" . $email . "'";
    if ($conn->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "0";
    }
} else echo "6";
