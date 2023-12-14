<?php
session_start();
// echo '<pre>';
// print_r($_POST);
// print_r($_FILES);
// print_r($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_login'])) {

  if (
    isset($_POST['username']) &&
    isset($_POST['email']) &&
    isset($_POST['address1']) &&
    isset($_POST['address2']) &&
    isset($_POST['phone']) &&
    isset($_POST['country']) &&
    isset($_POST['county']) &&
    isset($_POST['city']) &&
    isset($_POST['gender']) &&
    isset($_FILES['image'])
  ) {

    require_once '../connect.php';
    $user = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_SESSION['user_login']['id']}'");
    $user = mysqli_fetch_assoc($user);
    $errors_validate = [];
    $empty_errors = [];
    $num_error = 0;

    function clear($value)
    {
      $value = htmlspecialchars($value);
      $value = trim($value);
      // $value = strtolower($value);
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
    $address1 = clear($_POST['address1']);
    $address2 = clear($_POST['address2']);
    $gender = clear($_POST['gender']);
    $phone = clear($_POST['phone']);
    $country = clear($_POST['country']);
    $county = clear($_POST['county']);
    $city = clear($_POST['city']);

    check_empty($username); // 0
    check_empty($email); // 1
    check_empty($address1); // 2
    check_empty($phone); // 3
    check_empty($county); // 4
    check_empty($city); // 5

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
    if ($email != $user['email']) {
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
    }

    // gender validate
    if ($_POST['gender'] != 0 && $_POST['gender'] != 1) {
      $errors_validate['gender'] = 'Must Check on Role cannot be empty.';
    }

    // address validate
    if (isset($empty_errors[2])) {
      $errors_validate['address'] = 'Address cannot be empty.';
    }

    // phone validate
    if (isset($empty_errors[3])) {
      $errors_validate['phone'] = 'Phone cannot be empty.';
    }

    // country validate
    // يقوم بإرجاع كل ما هو موجود في ملف ال json
    $countries = json_decode(file_get_contents('../../js/countries.json'));
    // القيمه بشكل افتراضي خاطئه
    $errors_validate['country'] = 'The input field has been tampered with. Please try again, and if the problem persists, please <a href="../contact_us.php">contact us.</a>';
    // تحقق مما اذا كان اسم الدوله موجود في الملف ام لا
    foreach ($countries as $value) {
      if ($country == $value->name) {
        // اذا كان موجودا قم بازاله الخطأ
        unset($errors_validate['country']);
        break;
      }
    }

    // county validate
    if (isset($empty_errors[4])) {
      $errors_validate['county'] = 'County cannot be empty.';
    }

    // city validate
    if (isset($empty_errors[5])) {
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
      $image = $user['image'];
    }

    $_SESSION['update_person'] = [
      'username' => $username,
      'email' => $email,
      'address1' => $address1,
      'address2' => $address2,
      'gender' => $gender,
      'phone' => $phone,
      'country' => $country,
      'county' => $county,
      'city' => $city
    ];

    if (empty($errors_validate)) {


      // $password1 = md5($password1);
      $query = "UPDATE users SET
        username='$username',
        email='$email',
        address_1='$address1',
        address_2='$address2',
        gender='$gender',
        phone='$phone',
        image='$image',
        country='$country',
        county='$county',
        city='$city'
        WHERE id = '{$user['id']}'";

      try {
        mysqli_query($conn, $query);
      } catch (Exception $e) {
        $_SESSION['errors_update']['sql'] = $e->getMessage();
        header('location: ../../update_account.php');
        exit;
      }

      if ($image_bool) {
        // قم بحذف الصوره القديمه اذا لم يكن اسمها default.png لانه لا يجب ان يتم حذف الصوره القديمه
        if ($user['image'] != 'default.png') {
          unlink('../../files_users/' . $user['email'] . '/user_image/' . $user['image']);
        }
        move_uploaded_file($image_tmp, '../../files_users/' . $user['email'] . '/user_image/' . $image);
      }
      if ($user['email'] != $email) {
        rename('../../files_users/' . $user['email'], '../../files_users/' . $email);
      }
      move_uploaded_file($image_tmp, '../../files_users/' . $user['email'] . '/user_image/' . $image);

      header('location: ../../account.php');
      exit;
    } else {
      $_SESSION['errors_update'] = $errors_validate;
      header('location: ../../update_account.php');
      exit;
    }
  } else {
    $_SESSION['input_false_user_update'] = 'The input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="../contact_us.php">please contact us.</a>';
    header('location: ../../update_account.php');
    exit;
  }
} else {
  header('location: ../../');
  exit;
}
