<?php

require_once '../connect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['remove']) && isset($_SESSION['user_admin'])) {
    $id = htmlspecialchars($_POST['remove']);
    $query = "DELETE FROM users WHERE id = '$id'";
    if (!($query = mysqli_query($conn, $query))) {
      print_r($query);
    } else {
      header('location: ../../users.php');
    }
  } else {
    header('location: ../../../');
    exit;
  }
} else {
  header('location: ../../../');
  exit;
}