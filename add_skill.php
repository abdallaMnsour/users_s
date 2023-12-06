<?php
include 'includes/header.php';

// session_start();

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
<main>
  <section class="banner">
    <form action="functions/users/add_skill.php" method="post" class="p-5 m-auto" style="max-width: 500px;" enctype="multipart/form-data">


      <!-- التحقق مما اذا قام المستخدم بالقيام ببعض التعديلات في حقول الادخال -->
      <?php if (isset($_SESSION['input_false'])) : ?>
        <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?= $_SESSION['input_false'] ?></div>
      <?php endif; ?>

      <!-- التحقق مما اذا كان هناك خطا في ال sql ام لا -->
      <?php if (isset($_SESSION['errors']['sql'])) : ?>
        <div class="alert alert-danger mb-5"><i class="fa-solid fa-triangle-exclamation"></i> you have an error in you'r sql<br><b>message :</b> <?= $_SESSION['errors']['sql'] ?> please <a href="mailto:a.mansour.code@gmail.com">contact with developer</a></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="name" class="form-label">skill name <span class="text-danger">*</span></label>
        <input type="text" name="skill_name" class="form-control" id="name" placeholder="skill name ..." value="<?= $name_skill ?>" />
      </div>

      <?php if (isset($_SESSION['errors']['skill_name'])) : ?>
        <div class="alert alert-danger"><?= $_SESSION['errors']['skill_name'] ?></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="image" class="form-label">you'r image skill <span class="text-danger">*</span></label>
        <input class="form-control" type="file" id="image" name="image" />
      </div>

      <?php if (isset($_SESSION['errors']['image'])) : ?>
        <div class="alert alert-danger"><?= $_SESSION['errors']['image'] ?></div>
      <?php endif; ?>

      <!-- <div class="mb-3">
        <label for="customRange2" class="form-label d-flex justify-content-between"><span>Your experience <span class="text-danger">*</span></span><div id="rangeValue"></div></label>
        <input type="range" name="range" class="form-range" min="0" max="100" id="customRange2" onclick="updateValue(this)">
      </div> -->

      <input class="btn btn-primary" type="submit" value="submit" />

    </form>
    <form action="functions/users/add_skill.php" method="post" class="p-5 m-auto" style="max-width: 500px;" enctype="multipart/form-data">

      <!-- التحقق مما اذا قام المستخدم بالقيام ببعض التعديلات في حقول الادخال -->
      <?php if (isset($_SESSION['input_false'])) : ?>
        <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?= $_SESSION['input_false'] ?></div>
      <?php endif; ?>

      <!-- التحقق مما اذا كان هناك خطا في ال sql ام لا -->
      <?php if (isset($_SESSION['errors']['sql'])) : ?>
        <div class="alert alert-danger mb-5"><i class="fa-solid fa-triangle-exclamation"></i> you have an error in you'r sql<br><b>message :</b> <?= $_SESSION['errors']['sql'] ?> please <a href="mailto:a.mansour.code@gmail.com">contact with developer</a></div>
      <?php endif; ?>

      <div class="mb-3">
        <label for="cv" class="form-label">select you'r cv</label>
        <input class="form-control" type="file" id="cv" name="cv" />
        <p style="font-size: 14px;color: #db7474">Warning: If you select a new file, the old CV file will be deleted</p>
      </div>

      <?php if (isset($_SESSION['errors']['cv'])) : ?>
        <div class="alert alert-danger"><?= $_SESSION['errors']['cv'] ?></div>
      <?php endif; ?>

      <!-- <div class="mb-3">
        <label for="customRange2" class="form-label d-flex justify-content-between"><span>Your experience <span class="text-danger">*</span></span><div id="rangeValue"></div></label>
        <input type="range" name="range" class="form-range" min="0" max="100" id="customRange2" onclick="updateValue(this)">
      </div> -->

      <input class="btn btn-primary" type="submit" value="new cv" />

    </form>
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