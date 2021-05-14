<?php
require "DataBase.php";

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "ade_db";

$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (isset($_POST['code_client']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {

    $code_client = $_POST['code_client'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);



    if ($conn->connect_errno) {
        die("connection faild: " . $conn->connect_errno);
    }

    $sql = "SELECT * FROM client WHERE code_client='" . $code_client . "'";

    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {

        if ($row["username"] === NULL) {
            $sql = "SELECT * FROM client WHERE username='" . $username . "'";

            $result = $conn->query($sql);

            if ($result->fetch_assoc()) {
                echo "3";
            } else {
                $sql = "SELECT * FROM client WHERE email='" . $email . "'";
                $result = $conn->query($sql);

                if ($result->fetch_assoc()) {
                    echo "2";
                } else {
                    $sql = "UPDATE client SET email='" . $email . "', username='" . $username . "', password='" . $hashed_password . "' WHERE code_client='" . $code_client . "'";

                    if ($conn->query($sql) === TRUE) {
                        echo "1";
                    } else {
                        echo "0";
                    }
                }
            }
        } else {
            echo "4";
        }
    } else {
        echo "5";
    }
} else echo "6";
