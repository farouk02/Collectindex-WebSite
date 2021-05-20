<?php
if (isset($_POST['login-btn'])) {
  if (empty($_POST['username'])) {
    $errors['username'] = 'Username or email required';
  }
  if (empty($_POST['password'])) {
    $errors['password'] = 'Password required';
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (count($errors) === 0) {
    $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) { // if password matches
        $stmt->close();

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['verified'] = $user['verified'];
        $_SESSION['message'] = 'You are logged in!';
        $_SESSION['type'] = 'alert-success';
        header('location: index.php');
        exit(0);
      } else { // if password does not match
        $errors['login_fail'] = "Wrong username / password";
      }
    } else {
      $_SESSION['message'] = "Database error. Login failed!";
      $_SESSION['type'] = "alert-danger";
    }
  }
}
