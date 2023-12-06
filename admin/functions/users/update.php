<?php
session_start();
if (isset($_SESSION['user_admin']) && isset($_GET['user'])) {

    require_once '../connect.php';
    $user = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_GET['user']}'");

    if ($user->num_rows == 1) {

        $user = mysqli_fetch_assoc($user);

        if (isset($_SESSION['update_person'])) {

            $new = $_SESSION['update_person'];
            $username = $new['username'];
            $email = $new['email'];
            $address_1 = $new['address1'];
            $address_2 = $new['address2'];
            $gender = $new['gender'];
            $priv = $new['priv'];
            $phone = $new['phone'];
            $country = $new['country'];
            $county = $new['county'];
            $city = $new['city'];
        } else {

            $username = $user['username'];
            $email = $user['email'];
            $address_1 = $user['address_1'];
            $address_2 = $user['address_2'];
            $gender = $user['gender'];
            $priv = $user['priv'];
            $phone = $user['phone'];
            $image = $user['image'];
            $country = $user['country'];
            $county = $user['county'];
            $city = $user['city'];
        }

        $_SESSION['old_image'] = $user['image'];
        $_SESSION['old_email'] = $user['email'];
        $_SESSION['id_update_user'] = $user['id'];
    } else {

        $_SESSION['errors_update'] = 'no_user_database';
        header('location: ../../users.php');
        exit;
    }
} else {

    $_SESSION['errors_update'] = 'no_user_id';
    header('location: ../../users.php');
    exit;
}




// ادخل بيانا في الداتا بيز بكميه كبيره
// require_once '../connect.php';
// $male = ['ali', 'osama', 'mahmod', 'gamal', 'mazin', 'abdalla', 'ahmed', 'mohammed', 'aiob','eprahem', 'usof'];
// $female = ['shaimaa', 'yasmin', 'hoda', 'aliaa', 'sana', 'tasnim', 'esraa', 'zahraa', 'wegdaan','hend', 'salma'];
// $password = md5('testtesting');
// $rand = 'test testing';
// for ($i = 0; $i < 100; $i++) {
//   $phone = rand(1111111111, 99999999999);
//   $gender = rand(0, 1);
//   $email = uniqid() . '@gmail.com';
//   if ($gender == 0) {
//     $name = $male[array_rand($male)];
//   } else {
//     $name = $female[array_rand($female)];
//   }
//   mysqli_query($conn, "INSERT INTO users(
//     username,
//     password,
//     email,
//     address_1,
//     address_2,
//     gender,
//     priv,
//     phone,
//     image,
//     country,
//     county,
//     city
//   ) VALUES (
//     '$name',
//     '$password',
//     '$email',
//     '$rand',
//     '$rand',
//     '$gender',
//     '0',
//     '$phone',
//     'default.png',
//     'Egypt',
//     '$rand',
//     '$rand'
//   )");
// }
// echo '<Pre>';
// print_r($_SESSION);
// print_r($_POST);
// print_r($_FILES);
// echo '</Pre>';

// // $_SESSION['update_person'];
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta content="Premium Multipurpose Admin &amp; Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- App favicon -->
    <link href="../../assets/images/favicon.ico" rel="shortcut icon">

    <!-- Bootstrap Css -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="../../index.php" class="auth-logo">
                                <img src="../../assets/images/logo-dark.png" height="30" class="logo-dark mx-auto" alt="">
                                <img src="../../assets/images/logo-light.png" height="30" class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal mt-3" action="person_update.php" method="post" enctype="multipart/form-data">
                            <!-- التحقق مما اذا قام المستخدم بالقيام ببعض التعديلات في حقول الادخال -->
                            <?php if (isset($_SESSION['input_false_admin_update'])) : ?>
                                <div class="alert alert-danger mb-5"><i class="fa-solid fa-triangle-exclamation"></i> <?= $_SESSION['input_false'] ?></div>
                            <?php endif; ?>

                            <!-- التحقق مما اذا كان هناك خطا في ال sql ام لا -->
                            <?php if (isset($_SESSION['errors_update']['sql'])) : ?>
                                <div class="alert alert-danger mb-5"><i class="fa-solid fa-triangle-exclamation"></i> you have an error in you'r sql<br><b>message :</b> <?= $_SESSION['errors_update']['sql'] ?> please <a href="mailto:a.mansour.code@gmail.com">contact with developer</a></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="username" required="" placeholder="Username" value="<?= $username ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['username'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['username'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="email" name="email" required="" placeholder="Email" value="<?= $email ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['email'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['email'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="address1" required="" placeholder="Address_1" value="<?= $address_1 ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['address'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['address'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="address2" placeholder="Address_2" value="<?= $address_2 ?>" />
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="phone" required="" placeholder="Phone" value="<?= $phone ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['phone'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['phone'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3">
                                <label class="text-small text-uppercase" for="country">Country</label>
                                <select name="country" aria-label="Default select example" class="form-select selectpicker country w-100" id="country" data-width="fit" data-style="form-control form-control-lg" data-title="Select your country">
                                    <option value="<?= $country ?>"><?= $country ?></option>
                                </select>
                            </div>
                            <?php if (isset($_SESSION['errors_update']['country'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['country'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="county" required="" placeholder="County" value="<?= $county ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['county'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['county'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" type="text" name="city" required="" placeholder="City" value="<?= $city ?>" />
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['city'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['city'] ?></div>
                            <?php endif; ?>



                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <b>Gender</b><br>
                                    <input type="radio" name="gender" required="" value="0" <?= $gender == 0 ? 'checked' : '' ?> id=male /><label for="male">Male</label><br>
                                    <input type="radio" name="gender" required="" value="1" <?= $gender == 1 ? 'checked' : '' ?> id=female /><label for="female">Female</label>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['gender'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['gender'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <b>Privilege</b><br>
                                    <input type="radio" name="priv" required="" value="0" <?= $priv == 0 ? 'checked' : '' ?> id=user /><label for="user">User</label><br>
                                    <input type="radio" name="priv" required="" value="1" <?= $priv == 1 ? 'checked' : '' ?> id=admin /><label for="admin">Admin</label>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['priv'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['priv'] ?></div>
                            <?php endif; ?>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image (opt) <span style="font-size:10px" title="If you don't specify an image, it will not change the old image"><i class="fa-solid fa-circle-question"></i></span></label>
                                        <input class="form-control" type="file" id="image" name="image" />
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['errors_update']['image'])) : ?>
                                <div class="alert alert-danger mb-5"><?= $_SESSION['errors_update']['image'] ?></div>
                            <?php endif; ?>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->


    <!-- JAVASCRIPT -->
    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/node-waves/waves.min.js"></script>

    <script src="../../assets/js/app.js"></script>
    <script>
        $.getJSON('../../../js/countries.json', function(data) {
            $.each(data, function(key, value) {
                var selectOption = "<option value='" + value.name + "' data-dial-code='" + value.dial_code + "'>" + value.name + "</option>";
                $("select.country").append(selectOption);
            });
        })
    </script>
</body>

</html>
<?php
$_SESSION['input_false_admin_update'] = null;
$_SESSION['errors_update'] = null;
