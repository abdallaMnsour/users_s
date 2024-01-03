<?php
ob_start();

include 'includes/header.php';
if (!$user_bool) {
  header('location: index.php');
  exit;
}

$errors_bool = false;
if (isset($_SESSION['errors'])) {
  $errors_bool = true;
}
if (isset($_SESSION['skill_name'])) {
  $name_skill = $_SESSION['skill_name'];
} else {
  $name_skill = '';
}
?>
<style>
  section.account {
    max-width: 400px;
    margin: 150px auto 0;
  }

  section.account div img {
    width: 120px;
    height: 120px;
    box-shadow: 3px 2px 8px 4px #c3c3c3;
  }

  hr:not([size]) {
    height: 2px;
    background: #898989;
  }
</style>
<main>
  <section class="account">
    <div>
      <?php if ($user['image'] != 'default.png') : ?>
        <img src="files_users/<?= $user['email'] . '/user_image/' . $user['image'] ?>" />
      <?php else : ?>
        <img src="img/users/default.png" />
      <?php endif; ?>
    </div>
    <hr>
    <div>
      <p><b>Name :</b> <?= $user['username'] ?></p>
      <p><b>Email :</b> <?= $user['email'] ?></p>
      <p><b>Address 1 :</b> <?= $user['address_1'] ?></p>
      <p><b>Address 2 :</b> <?= $user['address_2'] ?></p>
      <p><b>Gender :</b> <?= $user['gender'] == 0 ? 'male' : 'female' ?></p>
      <p><b>Country :</b> <?= $user['country'] ?></p>
      <p><b>County :</b> <?= $user['county'] ?></p>
      <p><b>City :</b> <?= $user['city'] ?></p>
    </div>
    <hr>
    <div>
      <a class="btn btn-primary" href="update_account.php">Edit you'r account</a>
    </div>
  </section>
  <section class="banner pt-0">

    <form id="form_skill" action="functions/users/add_skill.php" method="post" class="p-5 m-auto" style="max-width: 500px;" enctype="multipart/form-data">
      <h2>ADD SKILL</h2>

      <span id="skill_status"></span>

      <div class="mb-3">
        <label for="name" class="form-label">skill name <span class="text-danger">*</span></label>
        <input type="text" name="skill_name" class="form-control" id="name" placeholder="skill name ..." value="<?= $name_skill ?>" />
      </div>

      <div id="skill_name_errors"></div>

      <div class="mb-3">
        <label for="image" class="form-label">you'r image skill <span class="text-danger">*</span></label>
        <input class="form-control" type="file" id="image" name="image" />
      </div>

      <div id="image_errors"></div>

      <!-- <div class="mb-3">
        <label for="customRange2" class="form-label d-flex justify-content-between"><span>Your experience <span class="text-danger">*</span></span><div id="rangeValue"></div></label>
        <input type="range" name="range" class="form-range" min="0" max="100" id="customRange2" onclick="updateValue(this)">
      </div> -->

      <button class="btn btn-primary" type="submit">add skill</button>

    </form>

    <form id="form_cv" action="functions/users/add_skill.php" method="post" class="p-5 m-auto" style="max-width: 500px;" enctype="multipart/form-data">

      <h2>ADD CV</h2>

      <span id="cv_status"></span>

      <div class="mb-3">
        <label for="cv" class="form-label">select you'r cv</label>
        <input class="form-control" type="file" id="cv" name="cv" />
        <p style="font-size: 14px;color: #db7474">Warning: If you select a new file, the old CV file will be deleted</p>
      </div>

      <div id="cv_errors"></div>

      <!-- <div class="mb-3">
        <label for="customRange2" class="form-label d-flex justify-content-between"><span>Your experience <span class="text-danger">*</span></span><div id="rangeValue"></div></label>
        <input type="range" name="range" class="form-range" min="0" max="100" id="customRange2" onclick="updateValue(this)">
      </div> -->

      <button class="btn btn-primary" type="submit">new cv</button>

    </form>
  </section>
  <section class="account mb-5">
      <a href="management.php?manage=services" class="btn btn-primary d-block mb-3">edit services</a>
      <a href="management.php?manage=works" class="btn btn-primary d-block mb-3">edit works</a>
  </section>
</main>
<script>
  // تحديث قيمة input range
  function updateValue(val) {
    val.onmousemove = function() {
      document.getElementById('rangeValue').innerText = val.value;
    }
  }
</script>

<?php
include 'includes/footer.php';
unset($_SESSION['skill_name']);
unset($_SESSION['errors']);
unset($_SESSION['input_false']);
?>
<script>
  let form_skill = document.getElementById('form_skill');
  let form_cv = document.getElementById('form_cv');

  let skill_name = document.getElementById('name');
  let image = document.getElementById('image');
  let cv = document.getElementById('cv');

  let cv_status = document.getElementById('cv_status');
  let skill_status = document.getElementById('skill_status');

  let skill_name_errors = document.getElementById('skill_name_errors');
  let image_errors = document.getElementById('image_errors');
  let cv_errors = document.getElementById('cv_errors');


  form_skill.addEventListener('submit', function(e) {

    e.preventDefault();

    let file = image.files[0];

    let formData = new FormData();

    formData.append('image', file);
    formData.append('skill_name', skill_name.value);

    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'functions/users/add_skill.php', true);

    xhr.send(formData);

    xhr.onload = function() {

      if (xhr.status == 200 && xhr.readyState == 4) {
        skill_status.innerHTML = '';
        skill_name_errors.innerHTML = '';
        image_errors.innerHTML = '';

        console.log(xhr.response);
        data = JSON.parse(xhr.response);
        console.log(data);

        if (data.skill_name) {
          skill_name_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>skill name error</strong><br>${data.skill_name}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.image) {
          image_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>image error</strong><br>${data.image}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.input_false) {
          skill_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>input error</strong><br>${data.input_false}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.sql) {
          skill_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>sql error</strong><br>${data.sql}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.success) {
          skill_name.value = '';
          image.value = '';

          skill_status.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong><br>${data.success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }

      } else {
        console.error(xhr.response);
      }
    }

  });
  form_cv.addEventListener('submit', function(e) {
    e.preventDefault();

    let file = cv.files[0];

    let data = new FormData();

    data.append('cv', file);

    let xml = new XMLHttpRequest();
    xml.open('POST', 'functions/users/add_skill.php', true);
    xml.send(data);
    xml.onload = function() {
      if (xml.status == 200 && xml.readyState == 4) {
        cv_status.innerHTML = '';
        cv_errors.innerHTML = '';

        console.log(xml.response);
        data = JSON.parse(xml.response);

        if (data.cv) {
          cv_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>cv error</strong><br>${data.cv}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.input_false) {
          cv_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>input error</strong><br>${data.input_false}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.sql) {
          cv_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>sql error</strong><br>${data.sql}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.success) {
          cv.value = '';
          cv_status.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong><br>${data.success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }

      } else {
        console.error(xml.response);
      }
    }
  });

  // function add_skill() {
  //   console.log('hello');
  // }

  // function add_cv() {
  //   console.log('cv');
  // }
</script>

<?php

ob_end_flush();
