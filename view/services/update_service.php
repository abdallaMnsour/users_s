<?php

$id = $_GET['id'];
$query = "SELECT * FROM services WHERE id = '$id'";
$query = mysqli_query($conn, $query);

$service = mysqli_fetch_assoc($query);

?>

<link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
  body {
    background-color: #e8e8e8;
  }
</style>
<div style="max-width: 500px;margin: 150px auto 0">
  <form id="form" class="pb-3">

    <div id="status_submit"></div>

    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" name="image" class="form-control" id="image">
    </div>
    <div id="image_input_error"></div>

    <div class="mb-3">
      <label for="name" class="form-label">Service name</label>
      <input type="text" name="name_service" class="form-control" id="name" value="<?= $service['service_name'] ?>">
    </div>
    <div id="name_input_error"></div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?= $service['description'] ?></textarea>
    </div>
    <div id="description_input_error"></div>

    <div class="mb-3">
      <label for="list" class="form-label">List</label>
      <textarea class="form-control" name="list" id="list" cols="30" rows="10"><?= $service['list'] ?></textarea>
    </div>
    <div id="list_input_error"></div>


    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="?manage=services" class="btn btn-secondary">Go back</a>

  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
  let form = document.getElementById('form');

  let image = document.getElementById('image');
  let name = document.getElementById('name');
  let description = document.getElementById('description');
  let list = document.getElementById('list');

  let status_submit = document.getElementById('status_submit');
  let name_input_error = document.getElementById('name_input_error');
  let image_input_error = document.getElementById('image_input_error');
  let description_input_error = document.getElementById('description_input_error');
  let list_input_error = document.getElementById('list_input_error');

  let log = console.log;
  form.onsubmit = function(e) {
    e.preventDefault();

    $_FILES['image']['tmp_name']

    let data = new FormData();
    data.append('image', image.files[0]);
    data.append('name_service', name.value);
    data.append('description', description.value);
    data.append('list', list.value);
    data.append('id', <?= $_GET['id'] ?>);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/users/services/update.php');
    xhr.send(data);
    xhr.onload = function() {
      name_input_error.innerHTML = '';
      image_input_error.innerHTML = '';
      description_input_error.innerHTML = '';
      status_submit.innerHTML = '';
      list_input_error.innerHTML = '';
      if (xhr.status == 200 && xhr.readyState == 4) {
        log(xhr.response);
        data = JSON.parse(xhr.response);
        if (data.input_false) {
          status_submit.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>input error</strong><br>${data.input_false}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.sql) {
          status_submit.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>sql error</strong><br>${data.sql}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.success) {
          // name.value = '';
          // image.value = '';
          // description.value = '';
          // list.value = '';

          name_input_error.innerHTML = '';
          image_input_error.innerHTML = '';
          description_input_error.innerHTML = '';
          list_input_error.innerHTML = '';

          status_submit.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>success</strong><br>${data.success}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;

        }
        if (data.name_serv) {
          name_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>name error</strong><br>${data.name_serv}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.image) {
          image_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>image error</strong><br>${data.image}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.description) {
          description_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>description error</strong><br>${data.description}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.list) {
          list_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>list error</strong><br>${data.list}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
      } else {
        console.error(xhr.response);
      }
    }
  }
</script>

