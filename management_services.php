<?php
ob_start();
include 'includes/header.php';
if (!$user_bool) {
  header('location: index.php');
  exit;
}

$query = 'SELECT * FROM services';

try {
  $query = mysqli_query($conn, $query);
} catch (Exception $e) {
  echo $e->getMessage();
}
?>
<main>
  <section class="banner m-5">
    <a href="add_service.php" class="btn btn-primary mb-5">add service</a>
    <table class="table table-info table-bordered table-hover border-dark">
      <thead>
        <tr>
          <th>id</th>
          <th>image</th>
          <th>name</th>
          <th>description</th>
          <th>list</th>
          <th>control</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($service = mysqli_fetch_assoc($query)) : ?>
        <tr>
          <th><?= $service['id'] ?></th>
          <th>
            <img width="50" src="files_users/<?= $user['email'] ?>/services/<?= $service['image'] ?>" alt="image_service" />
          </th>
          <th><?= $service['service_name'] ?></th>
          <th><?= $service['description'] ?></th>
          <th><?= $service['list'] ?></th>
          <th>
            <a class="btn d-block mb-1">update</a>
            <a class="btn bg-danger d-block">delete</a>
          </th>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </section>
</main>
<?php
include 'includes/footer.php';
ob_end_flush();
?>