<?php
require_once '../connect.php';

session_start();

$errors_validate = [];

function clear($value)
{
  $value = htmlspecialchars($value);
  $value = trim($value);
  $value = addslashes($value);
  return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['phone']) &&
    isset($_POST['message'])
  ) {
    $name = clear($_POST['name']);
    $email = clear($_POST['email']);
    $phone = clear($_POST['phone']);
    $message = clear($_POST['message']);

    // name validate
    if ($name == '') {
      $errors_validate['name'] = 'Name cannot be empty.';
    } else if (strlen($name) < 3 || strlen($name) > 50) {
      $errors_validate['name'] = 'Name must be between 3 and 50 characters long.';
    }

    // email validate
    if ($email == '') {
      $errors_validate['email'] = 'Email cannot be empty.';
    } else {
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      if ($email == false) {
        $errors_validate['email'] = 'Invalid email format.';
      }
    }

    // phone validate
    if ($phone == '') {
      $errors_validate['phone'] = 'phone cannot be empty';
    }

    // message validate
    if ($message == '') {
      $errors_validate['message'] = 'message cannot be empty';
    } else if (strlen($message) < 20 || strlen($message) > 500) {
      $errors_validate['message'] = 'min characters is 20 and max is 500';
    }

    if (empty($errors_validate)) {

      try {
        $query = "INSERT INTO messages (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
        mysqli_query($conn, $query);
      } catch (Exception $e) {
        echo json_encode(['sql' => $e->getMessage()]);
        exit;
      }

      echo json_encode(['success' => 'the message has been sent successfully']);
    } else {
      echo json_encode($errors_validate);
    }
  } else {
    echo json_encode(['input_false' => 'The input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="contact.php">please contact us.</a>']);
  }
} else {
  header('location: ../../');
  exit;
}
