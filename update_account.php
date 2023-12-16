<?php

ob_start();

include 'includes/header.php';

if (isset($_SESSION['user_login'])) {

  if (isset($_SESSION['update_person'])) {

    $new = $_SESSION['update_person'];
    $username = $new['username'];
    $email = $new['email'];
    $address_1 = $new['address1'];
    $address_2 = $new['address2'];
    $gender = $new['gender'];
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
    $phone = $user['phone'];
    $country = $user['country'];
    $county = $user['county'];
    $city = $user['city'];

  }
  $_SESSION['old_email'] = $user['email'];
} else {

  $_SESSION['errors_update'] = 'no_user_id';
  header('location: index.php');
  exit;

}

?>
<style>
  .wrapper-page {
    max-width: 500px;
    margin: 200px auto 0;
  }
</style>

  <div class="bg-overlay"></div>
  <div class="wrapper-page">
    <div class="container-fluid p-0">
      <div class="card">
        <div class="card-body">

          <h4 class="text-muted text-center font-size-18"><b>Register</b></h4>

          <div class="p-3">
            <form class="form-horizontal mt-3" action="functions/users/edit_account_user.php" method="post" enctype="multipart/form-data">
              <!-- التحقق مما اذا قام المستخدم بالقيام ببعض التعديلات في حقول الادخال -->
              <?php if (isset($_SESSION['input_false_user_update'])) : ?>
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
  <script src="js/jquery-3.6.1.min.js"></script>
  <!-- <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../assets/libs/node-waves/waves.min.js"></script> -->

  <!-- <script src="../../assets/js/app.js"></script> -->
  <script>
    $.getJSON('js/countries.json', function(data) {
      $.each(data, function(key, value) {
        var selectOption = "<option value='" + value.name + "' data-dial-code='" + value.dial_code + "'>" + value.name + "</option>";
        $("select.country").append(selectOption);
      });
    })
  </script>

<?php
include 'includes/footer.php';
$_SESSION['input_false_user_update'] = null;
$_SESSION['errors_update'] = null;
ob_end_flush();
