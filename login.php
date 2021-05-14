<?php

require "DataBaseConfig.php";

$dbC = new DataBaseConfig();

$servername = $dbC->servername;
$dbusername = $dbC->username;
$dbpassword = $dbC->password;
$dbname = $dbC->databasename;


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_errno) {
        die("connection faild: " . $conn->connect_errno);
    }

    $sql = "SELECT * FROM client WHERE username='" . $username . "'";

    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            echo $row["code_client"] . ";" . $row["firstname"] . " " . $row["lastname"];
        } else {
            echo "2";
        }
    } else {
        echo "2";
    }
} else echo "3";
