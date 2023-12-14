<?php
require_once '../../connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_login']) && isset($_POST['service_id'])) {
  try {
    $query = "DELETE FROM services WHERE id = '{$_POST['service_id']}'";
    mysqli_query($conn, $query);
    echo 'success';
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}
