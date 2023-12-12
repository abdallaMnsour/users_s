<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['password1']) &&
    isset($_POST['password2']) &&
    isset($_POST['address1']) &&
    isset($_POST['address2']) &&
    isset($_POST['gender']) &&
    isset($_POST['phone']) &&
    isset($_POST['country']) &&
    isset($_POST['county']) &&
    isset($_POST['city'])
  ) {

    require_once '../connect.php';
    $empty_errors = [];
    $errors_validate = [];
    $num_error = 0;

    function clear($value)
    {
      $value = htmlspecialchars($value);
      $value = trim($value);
      return $value;
    }

    function check_empty($value)
    {
      global $empty_errors, $num_error;
      if ($value == '') {
        $empty_errors[$num_error] = 'empty';
      }
      $num_error++;
    }

    $username = clear($_POST['username']);
    $email = clear($_POST['email']);
    $password1 = clear($_POST['password1']);
    $password2 = clear($_POST['password2']);
    $address1 = clear($_POST['address1']);
    $address2 = clear($_POST['address2']);
    $gender = clear($_POST['gender']);
    $phone = clear($_POST['phone']);
    $country = clear($_POST['country']);
    $county = clear($_POST['county']);
    $city = clear($_POST['city']);

    check_empty($username); // 0
    check_empty($email); // 1
    check_empty($password1); // 2
    check_empty($address1); // 3
    check_empty($phone); // 4
    check_empty($county); // 5
    check_empty($city); // 6

    // username validate
    if (isset($empty_errors[0])) {
      $errors_validate['username'] = 'Username cannot be empty.';
    } else if (strlen($username) < 5 || strlen($username) > 20) {
      $errors_validate['username'] = 'Username must be between 5 and 20 characters long.';
    } else {
      preg_match('/\w+/i', $username, $userTest);
      if (strlen($userTest[0]) != strlen($username)) {
        $errors_validate['username'] = 'Username can only contain letters, numbers, and underscores.';
      }
    }

    // email validate
    if (isset($empty_errors[1])) {
      $errors_validate['email'] = 'Email cannot be empty.';
    } else {
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      if ($email == false) {
        $errors_validate['email'] = 'Invalid email format.';
      }
      $query = "SELECT id FROM users WHERE email = '$email'";
      $query = mysqli_query($conn, $query);
      if ($query->num_rows > 0) {
        $errors_validate['email'] = 'This email is already reserved';
      }
    }

    // password validate
    if (isset($empty_errors[2])) {
      $errors_validate['password'] = 'Password cannot be empty.';
    } elseif (strlen($password1) < 8) {
      $errors_validate['password'] = 'Password must be at least 8 characters long.';
    } else {
      preg_match('/[\w\s]+/i', $password1, $passTest);
      if (strlen($passTest[0]) != strlen($password1)) {
        $errors_validate['password'] = 'Password can only contain letters, numbers, and underscores.';
      } else if ($password1 != $password2) {
        $errors_validate['password2'] = 'Passwords do not match';
      }
    }

    // gender validate
    if ($_POST['gender'] != 0 && $_POST['gender'] != 1) {
      $errors_validate['gender'] = 'Must Check on Role cannot be empty.';
    }

    // address validate
    if (isset($empty_errors[3])) {
      $errors_validate['address'] = 'Address cannot be empty.';
    }

    // phone validate
    if (isset($empty_errors[4])) {
      $errors_validate['phone'] = 'Phone cannot be empty.';
    }

    // country validate
    $countries = json_decode(file_get_contents('../../js/countries.json'));
    $errors_validate['country'] = 'The input field has been tampered with. Please try again, and if the problem persists, please <a href="contact.php">contact us.</a>';
    foreach ($countries as $value) {
      if ($country == $value->name) {
        unset($errors_validate['country']);
        break;
      }
    }

    // county validate
    if (isset($empty_errors[5])) {
      $errors_validate['county'] = 'County cannot be empty.';
    }

    // city validate
    if (isset($empty_errors[6])) {
      $errors_validate['city'] = 'City cannot be empty.';
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
      $image = 'default.png';
    }

    $_SESSION['person'] = [
      'username' => $username,
      'email' => $email,
      'password1' => $password1,
      'password2' => $password2,
      'address1' => $address1,
      'address2' => $address2,
      'phone' => $phone,
      'country' => $country,
      'county' => $county,
      'city' => $city,
      'gender' => $gender
    ];

    if (empty($errors_validate)) {

      $password1 = md5($password1);
      $email = addslashes($email);
      $address1 = addslashes($address1);
      $address2 = addslashes($address2);
      $phone = addslashes($phone);
      $image = addslashes($image);
      $country = addslashes($country);
      $county = addslashes($county);
      $city = addslashes($city);

      $query = "INSERT INTO users (
        username,
        email,
        password,
        gender,
        address_1,
        address_2,
        phone,
        image,
        country,
        county,
        city
      ) VALUES (
        '$username',
        '$email',
        '$password1',
        '$gender',
        '$address1',
        '$address2',
        '$phone',
        '$image',
        '$country',
        '$county',
        '$city')";

      try {
        mysqli_query($conn, $query);
      } catch (Exception $e) {
        $_SESSION['errors']['sql'] = $e->getMessage();
        header('location: ../../login/register.php');
        exit;
      }

      if ($image_bool) {
        move_uploaded_file($image_tmp, '../../img/users/' . $image);
      }
      mkdir('../../files_users/' . $email);
      mkdir('../../files_users/' . $email . '/services');
      mkdir('../../files_users/' . $email . '/skills');
      mkdir('../../files_users/' . $email . '/cv');
      session_unset();
      $query = "SELECT * FROM users WHERE email = '$email'";
      $query = mysqli_query($conn, $query);
      $user = [];
      foreach (mysqli_fetch_assoc($query) as $key => $value) {
        $user[$key] = stripslashes($value);
      }
      $_SESSION['user_login'] = $user;
      header('location: ../../');
      exit;
    } else {
      $_SESSION['errors'] = $errors_validate;
      header('location: ../../login/register.php');
      exit;
    }
  } else {
    $_SESSION['input_false'] = 'The input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="contact.php">please contact us.</a>';
    header('location: ../../login/register.php');
    exit;
  }
} else {
  header('location: ../../');
  exit;
}
