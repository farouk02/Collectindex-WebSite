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


if (isset($_POST['email'])) {

    $email = $_POST['email'];

    $token = bin2hex(random_bytes(50)); // generate unique token




    $sql = "SELECT * FROM client WHERE email='" . $email . "'";

    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {

        if ($row['verified'] === "1") {
            $sql = "UPDATE client SET verified = 0, token = null WHERE email='" . $email . "'";
            if ($conn->query($sql) === TRUE) {
                echo "1";
            }
        } else {
            if (sendVerificationEmail($email, $token)) {
                $sql = "UPDATE client SET token='" . $token . "' WHERE email='" . $email . "'";

                if ($conn->query($sql) === TRUE) {
                    echo "7";
                }
            } else {
                echo "8";
            }
        }
    } else {
        echo "5";
    }
} else echo "6";
