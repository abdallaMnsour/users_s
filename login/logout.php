<?php

// rmdir('../files_users/' . $_SESSION['user_login']['email']);

if (isset($_COOKIE['user_login_id'])) {
  setcookie('user_login_id', '', time() - 3600, '/');
}

session_start();
session_unset();
session_destroy();
header('location: ../');
exit;
