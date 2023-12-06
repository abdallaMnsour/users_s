<?php
echo '<pre>';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_admin'])) {

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
    isset($_POST['priv'])
  ) {

    require_once '../connect.php';
    $empty_errors = [];
    $errors_validate = [];
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
    // $password1 = clear($_POST['password1']);
    // $password2 = clear($_POST['password2']);
    $address1 = clear($_POST['address1']);
    $address2 = clear($_POST['address2']);
    $gender = clear($_POST['gender']);
    $phone = clear($_POST['phone']);
    $country = clear($_POST['country']);
    $county = clear($_POST['county']);
    $city = clear($_POST['city']);
    $priv = clear($_POST['priv']);

    check_empty($username); // 0
    check_empty($email); // 1
    // check_empty($password1);  2
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
    if ($email != $_SESSION['old_email']) {
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

    // password validate
    // if (isset($empty_errors[2])) {
    //   $errors_validate['password'] = 'Password cannot be empty.';
    // } elseif (strlen($password1) < 8) {
    //   $errors_validate['password'] = 'Password must be at least 8 characters long.';
    // } else {
    //   preg_match('/[\w\s]+/i', $password1, $passTest);
    //   if (strlen($passTest[0]) != strlen($password1)) {
    //     $errors_validate['password'] = 'Password can only contain letters, numbers, and underscores.';
    //   } else if ($password1 != $password2) {
    //     $errors_validate['password2'] = 'Passwords do not match';
    //   }
    // }

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
    $countries = json_decode(file_get_contents('../../../js/countries.json'));
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

    // gender validate
    if ($_POST['priv'] != 0 && $_POST['priv'] != 1) {
      $errors_validate['priv'] = 'Must Check on Role cannot be empty.';
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
      $image = $_SESSION['old_image'];
    }

    $_SESSION['update_person'] = [
      'username' => $username,
      'email' => $email,
      // 'password1' => $password1,
      // 'password2' => $password2,
      'address1' => $address1,
      'address2' => $address2,
      'gender' => $gender,
      'phone' => $phone,
      'country' => $country,
      'county' => $county,
      'city' => $city,
      'priv' => $priv
    ];

    if (empty($errors_validate)) {


      // $password1 = md5($password1);
      $query = "UPDATE users SET
        username='$username',
        email='$email',
        address_1='$address1',
        address_2='$address2',
        gender='$gender',
        priv='$priv',
        phone='$phone',
        image='$image',
        country='$country',
        county='$county',
        city='$city'
        WHERE id = '{$_SESSION['id_update_user']}'";

      try {
        mysqli_query($conn, $query);
      } catch (Exception $e) {
        $_SESSION['errors_update']['sql'] = $e->getMessage();
        header('location: update.php?user=' . $_SESSION['id_update_user']);
        exit;
      }

      if ($image_bool) {
        // قم بحذف الصوره القديمه اذا لم يكن اسمها default.png لانه لا يجب ان يتم حذف الصوره القديمه
        if ($_SESSION['old_image'] != 'default.png') {
          unlink('../../../img/users/' . $_SESSION['old_image']);
        }
        move_uploaded_file($image_tmp, '../../../img/users/' . $image);
      }

      header('location: ../../users.php');
      exit;
    } else {
      $_SESSION['errors_update'] = $errors_validate;
      header('location: update.php?user=' . $_SESSION['id_update_user']);
      exit;
    }
  } else {
    $_SESSION['input_false_admin_update'] = 'The input fields have been manipulated, please try reloading the page.<br>If the problem persists, <a href="../contact_us.php">please contact us.</a>';
    header('location: update.php?user=' . $_SESSION['id_update_user']);
    exit;
  }
} else {
  header('location: ../../../');
  exit;
}
