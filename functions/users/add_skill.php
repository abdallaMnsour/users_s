<?php
require_once '../connect.php';

session_start();

$errors_validate = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_login'])) {

  $user = $_SESSION['user_login'];

  if (isset($_POST['skill_name']) && isset($_FILES['image'])) {
    $skill_name = htmlspecialchars($_POST['skill_name']);
    $skill_name = trim($skill_name);
    // skill name validate
    if ($skill_name == '') {
      $errors_validate['skill_name'] = 'Skill name cannot be empty.';
    } else if (strlen($skill_name) < 3 || strlen($skill_name) > 50) {
      $errors_validate['skill_name'] = 'Skill name must be between 3 and 50 characters long.';
    }

    // image validate
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];
    $image_size = $_FILES['image']['size'];
    $image_bool = false;

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
    } else {
      $errors_validate['image'] = 'you have to upload an image';
    }




    if (empty($errors_validate)) {

      try {

        $query = "INSERT INTO skills (skill_name, image, user_id) VALUES ('$skill_name', '$image', '{$user['id']}')";
        mysqli_query($conn, $query);
      } catch (Exception $e) {

        echo json_encode(['sql' => $e->getMessage()]);
        exit;
      }

      if ($image_bool) {
        move_uploaded_file($image_tmp, '../../files_users/' . $user['email'] . '/' . $image);
      }
      echo json_encode(['success' => 'skill added successfully']);
    } else {
      echo json_encode($errors_validate);
    }
  } else if (isset($_FILES['cv'])) {

    // cv validate
    $cv_name = $_FILES['cv']['name'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $cv_error = $_FILES['cv']['error'];
    $cv_size = $_FILES['cv']['size'];
    $cv_bool = false;

    if ($cv_error == 0) {
      if ($cv_size < 2 * 1024 * 1024) {
        $ext = ['docx', 'pdf'];
        $type = explode('.', $cv_name);
        $type = strtolower(end($type));
        if (in_array($type, $ext)) {
          $cv = uniqid() . '.' . $type;
          $cv_bool = true;
        } else {
          $errors_validate['cv'] = 'you can only upload an cv';
        }
      } else {
        $errors_validate['cv'] = 'you\'r cv is too big';
      }
    } else {
      $errors_validate['cv'] = 'you have to upload an cv';
    }

    if (empty($errors_validate)) {

      if ($user['cv'] != 'no_cv') {
        unlink('../../files_users/' . $user['email'] . '/' . $user['cv']);
      }

      try {
        $query = "UPDATE users SET cv = '$cv' WHERE id = '{$user['id']}'";
        mysqli_query($conn, $query);
      } catch (Exception $e) {
        echo json_encode(['sql' => $e->getMessage()]);
        exit;
      }

      if ($cv_bool) {
        move_uploaded_file($cv_tmp, '../../files_users/' . $user['email'] . '/' . $cv);
      }
      $_SESSION['user_login']['cv'] = $cv;
      echo json_encode(['success' => 'cv added successfully']);
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
