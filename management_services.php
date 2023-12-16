<?php
ob_start();
include 'includes/header.php';
if (!$user_bool) {
  header('location: index.php');
  exit;
}

$query = "SELECT * FROM services WHERE user_id = '{$user['id']}'";

try {
  $query = mysqli_query($conn, $query);
} catch (Exception $e) {
  echo $e->getMessage();
}
?>



<!-- Modal -->
<div class="modal fade close" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">delete service</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        are you sour you want delete this service ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-secondary" data-bs-dismiss="modal">Close</button>
        <button id="remove_serv" type="button" class="btn bg-danger" data-service="" onclick="remove_service(this)">Delete</button>
      </div>
    </div>
  </div>
</div>

<main>
  <section class="banner m-5">
    <a href="add_service.php" class="btn btn-primary mb-5">add service</a>
    <table class="table table-bordered table-hover border-dark">
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
          <tr id="row_<?= $service['id'] ?>">
            <th><?= $service['id'] ?></th>
            <th>
              <img width="50" src="files_users/<?= $user['email'] ?>/services/<?= $service['image'] ?>" alt="image_service" data-name="<?= $service['image'] ?>" />
            </th>
            <th><?= $service['service_name'] ?></th>
            <th><?= $service['description'] ?></th>
            <th><?= $service['list'] ?></th>
            <th>
              <a href="functions/users/services/update_service.php?id=<?= $service['id'] ?>" class="btn d-block mb-1">update</a>

              <!-- Button trigger modal -->
              <button onclick="delete_service(<?= $service['id'] ?>)" type="button" class="btn bg-danger d-block w-100 p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                delete
              </button>
            </th>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </section>
</main>
<script>
  let remove_serv = document.getElementById('remove_serv');
  let close = document.querySelector('.close');

  function delete_service(id) {
    remove_serv.dataset.service = id;
  }

  function remove_service(element) {
    let modal = document.querySelector('.modal-backdrop.fade.show');
    let row = document.querySelector(`tr#row_${element.dataset.service}`);
    let img = document.querySelector(`tr#row_${element.dataset.service} th img`);
    let data = new FormData();
    data.append('service_id', element.dataset.service);
    data.append('image', img.dataset.name);


    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/users/services/delete_service.php');
    xhr.send(data);
    xhr.onload = function() {
      if (xhr.status == 200 && xhr.readyState == 4) {
        if (xhr.response == 'success') {
          row.style.display = 'none';
          close.style.display = 'none';
          modal.style.display = 'none';
        } else {
          console.error(xhr.response);
        }
      } else {
        console.error(xhr.response);
      }
    }
  }
</script>
<?php
include 'includes/footer.php';
ob_end_flush();
?>