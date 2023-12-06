<?php
session_start();
function clear ($value) {
  $value = htmlspecialchars($value);
  $value = trim($value);
  return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
  require_once '../connect.php';

  $email = clear($_POST['email']);
  $password = md5(clear($_POST['password']));

  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND priv = '1'";

  if ($query = mysqli_query($conn, $query)) {

    if ($query->num_rows == 1) {
      $_SESSION['user_admin'] = mysqli_fetch_assoc($query);
      header('location: ../../');
    } else {
      header('location: ../../auth-login.php?no_user=' . $email);
    }
  }

} else {
  header('location: ../../');
  exit;
}
