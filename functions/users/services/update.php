<?php
require_once '../../connect.php';

session_start();

$errors_validate = [];

function clear($value)
{
  $value = htmlspecialchars($value);
  $value = trim($value);
  return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_login'])) {

  $user = $_SESSION['user_login'];

  if (
    isset($_POST['id']) &&
    isset($_POST['name_service']) &&
    isset($_POST['description']) &&
    // isset($_FILES['image']) &&
    isset($_POST['list'])
  ) {
    $id = $_POST['id'];
    $name_serv = clear($_POST['name_service']);
    $desc = clear($_POST['description']);
    $list = clear($_POST['list']);

    // name service validate
    if ($name_serv == '') {
      $errors_validate['name_serv'] = 'Service name cannot be empty.';
    }

    // description validate
    if ($desc == '') {
      $errors_validate['description'] = 'Description cannot be empty.';
    } else if (strlen($desc) < 10 || strlen($desc) > 500) {
      $errors_validate['description'] = 'Description must be between 10 and 500 characters long.';
    }

    // list validate
    if ($list == '') {
      $errors_validate['list'] = 'List cannot be empty.';
    } else if (strlen($list) < 10 || strlen($list) > 500) {
      $errors_validate['list'] = 'List must be between 10 and 500 characters long.';
    }

    // image validate

    $image_bool = false;
    if (isset($_FILES['image'])) {
      $image_name = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      $image_error = $_FILES['image']['error'];
      $image_size = $_FILES['image']['size'];
  
      if ($image_error == 0) {
        if ($image_size < 2 * 1024 * 1024) {
          $ext = ['jpg', 'png', 'jpeg'];
          $type = explode('.', $image_name);
          $type = strtolower(end($type));
          if (in_array($type, $ext)) {
            $image = uniqid() . '.' . $type;
            // لم اقم بنقل الصوره عندي لانه اذا لم تنفذ الكويري سوف يقوم برفع صوره رغم ذلك
            $image_bool = true;
          } else {
            $errors_validate['image'] = 'you can only upload an image';
          }
        } else {
          $errors_validate['image'] = 'you\'r image is too big';
        }
      }
    }






    if (empty($errors_validate)) {

      try {

        $query = "SELECT image FROM services WHERE id = '$id'";

        $query = mysqli_query($conn, $query);

        $query = mysqli_fetch_assoc($query);
        if ($image_bool) {
          $image_old = $query['image'];
          $query = "UPDATE services SET service_name='$name_serv', description='$desc', list='$list', image='$image' WHERE id = '$id'";
        } else {
          $query = "UPDATE services SET service_name='$name_serv', description='$desc', list='$list' WHERE id = '$id'";
        }
        mysqli_query($conn, $query);
      } catch (Exception $e) {

        echo json_encode(['sql' => $e->getMessage()]);
        exit;
      }

      if ($image_bool) {
        unlink('../../../files_users/' . $user['email'] . '/services/' . $image_old);
        move_uploaded_file($image_tmp, '../../../files_users/' . $user['email'] . '/services/' . $image);
      }
      echo json_encode(['success' => 'service added successfully']);
    } else {
      echo json_encode($errors_validate);
    }
  } else {
    echo json_encode(['input_false' => 'You have select an image<br><br>Or the input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="contact.php">please contact us.</a>']);
  }
} else {
  header('location: ../../../');
  exit;
}
