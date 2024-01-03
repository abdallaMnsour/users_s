<?php
ob_start();

if (!isset($page_bool)) {
  header('location: ../');
  exit;
};

$query = 'SELECT * FROM services';

try {
  $query = mysqli_query($conn, $query);
} catch (Exception $e) {
  echo $e->getMessage();
}
?>
<style>
  form {
    max-width: 500px;
    margin: auto;
  }
</style>
<main>
  <section class="banner m-5">
    <form id="form" method="post" enctype="multipart/form-data">

      <div id="service_status"></div>

      <div class="mb-3">
        <label for="name" class="form-label">Service name</label>
        <input name="name_service" type="text" class="form-control" id="name" />
      </div>

      <div id="name_serv_errors"></div>

      <div class="mb-3">
        <label for="image" class="form-label">Image service</label>
        <input name="image" type="file" class="form-control" id="image" />
      </div>

      <div id="image_errors"></div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" cols="5" rows="7"></textarea>
      </div>

      <div id="description_errors"></div>

      <div class="mb-3">
        <label for="list" class="form-label">list</label>
        <!-- <b class="text-small">rules : <span></span></b> -->
        <textarea class="form-control" name="list" id="list" rows="7"></textarea>
      </div>

      <div id="list_errors"></div>

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Add service</button>
        <a href="?manage=services" class="btn bg-secondary">back</a>
      </div>
    </form>


  </section>
</main>
<script>
  let form = document.getElementById('form');

  let name_serv = document.getElementById('name');
  let image = document.getElementById('image');
  let description = document.getElementById('description');
  let list = document.getElementById('list');

  let service_status = document.getElementById('service_status');

  let name_serv_errors = document.getElementById('name_serv_errors');
  let image_errors = document.getElementById('image_errors');
  let description_errors = document.getElementById('description_errors');
  let list_errors = document.getElementById('list_errors');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    let data = new FormData;
    data.append('image', image.files[0]);
    data.append('name_service', name_serv.value);
    data.append('description', description.value);
    data.append('list', list.value);

    let xhr = new XMLHttpRequest;
    xhr.open('POST', 'functions/users/services/add_service.php');
    xhr.send(data);
    xhr.onload = function() {
      if (xhr.status == 200 && xhr.readyState == 4) {

        service_status.innerHTML = '';

        name_serv_errors.innerHTML = '';
        image_errors.innerHTML = '';
        list_errors.innerHTML = '';
        description_errors.innerHTML = '';

        data = JSON.parse(xhr.response);
        if (data.name_serv) {
          name_serv_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>name service name error</strong><br>${data.name_serv}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.description) {
          description_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>description error</strong><br>${data.description}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.list) {
          list_errors.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>list error</strong><br>${data.list}
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
          service_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>input error</strong><br>${data.input_false}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.sql) {
          service_status.innerHTML = `
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>sql error</strong><br>${data.sql}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
        if (data.success) {
          name_serv.value = '';
          image.value = '';
          description.value = '';
          list.value = '';

          service_status.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong><br>${data.success}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
        }
      } else {
        console.error(xhr);
      }
    }
  })
</script>
<?php
ob_end_flush();
?>