<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['fullname']);
unset($_SESSION['is_admin']);

if (!isset($_SESSION['id'])) {
  header("location: adminLogin.php");
}
