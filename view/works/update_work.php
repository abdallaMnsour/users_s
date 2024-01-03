<?php

if (!isset($page_bool)) {
  header('location: ../');
  exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM works WHERE id = '$id'";
$query = mysqli_query($conn, $query);

// اذا كان رقم ال id لا يساوي 1 فهذا يعني انه تم الدخول بطريقه غير شرعيه
if (mysqli_num_rows($query) != 1) {
  header('location: ../');
  exit;
}

$work = mysqli_fetch_assoc($query);

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
      <label for="name" class="form-label">title name</label>
      <input type="text" name="title" class="form-control" id="name" value="<?= $work['title'] ?>">
    </div>
    <div id="title_input_error"></div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?= $work['description'] ?></textarea>
    </div>
    <div id="description_input_error"></div>

    <div class="mb-3">
      <label for="client_name" class="form-label">Client name</label>
      <input class="form-control" name="client_name" id="client_name" cols="30" rows="10" value="<?= $work['client_name'] ?>" />
    </div>
    <div id="client_name_input_error"></div>

    <div class="mb-3">
      <label for="date" class="form-label">Date</label>
      <input type="date" class="form-control" name="date" id="date" cols="30" rows="10" value="<?= $work['date'] ?>" />
    </div>
    <div id="date_input_error"></div>

    <div class="mb-3">
      <label for="location" class="form-label">Location</label>
      <input class="form-control" name="location" id="location_work" cols="30" rows="10" value="<?= $work['location'] ?>" />
    </div>
    <div id="location_input_error"></div>

    <div class="mb-3">
      <label for="project_link" class="form-label">Project link</label>
      <input class="form-control" name="project_link" id="project_link" cols="30" rows="10" value="<?= $work['project_link'] ?>" />
    </div>
    <div id="project_link_input_error"></div>

    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <input class="form-control" name="category" id="category" cols="30" rows="10" value="<?= $work['category'] ?>" />
    </div>
    <div id="category_input_error"></div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="?manage=works" class="btn btn-secondary">Go back</a>

  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>

  let form = document.getElementById('form');

  let image = document.getElementById('image');
  let name = document.getElementById('name');
  let description = document.getElementById('description');
  let client_name = document.getElementById('client_name');
  let date = document.getElementById('date');
  let location_work = document.getElementById('location_work');
  let project_link = document.getElementById('project_link');
  let category = document.getElementById('category');


  let status_submit = document.getElementById('status_submit'),
    title_input_error = document.getElementById('title_input_error'),
    image_input_error = document.getElementById('image_input_error'),
    description_input_error = document.getElementById('description_input_error'),
    client_name_input_error = document.getElementById('client_name_input_error'),
    date_input_error = document.getElementById('date_input_error'),
    location_input_error = document.getElementById('location_input_error'),
    project_link_input_error = document.getElementById('project_link_input_error'),
    category_input_error = document.getElementById('category_input_error');



  let log = console.log;
  form.onsubmit = function(e) {
    e.preventDefault();

    let data = new FormData();
    data.append('image', image.files[0]);
    data.append('title', name.value);
    data.append('description', description.value);
    data.append('client_name', client_name.value);
    data.append('date', date.value);
    data.append('location_work', location_work.value);
    data.append('project_link', project_link.value);
    data.append('category', category.value);

    data.append('id', <?= $_GET['id'] ?>);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/users/works/update.php');
    xhr.send(data);
    xhr.onload = function() {

      // 
      title_input_error.innerHTML = '';
      image_input_error.innerHTML = '';
      description_input_error.innerHTML = '';
      status_submit.innerHTML = '';
      client_name_input_error.innerHTML = '';
      date_input_error.innerHTML = '';
      location_input_error.innerHTML = '';
      project_link_input_error.innerHTML = '';
      category_input_error.innerHTML = '';

      if (xhr.status == 200 && xhr.readyState == 4) {
        log(xhr.response);
        data = JSON.parse(xhr.response);
        if (data.status) {
          status_submit.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>input error</strong><br>${data.status}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.success) {
          // name.value = '';
          // image.value = '';
          // description.value = '';
          // client_name.value = '';

          title_input_error.innerHTML = '';
          image_input_error.innerHTML = '';
          description_input_error.innerHTML = '';
          client_name_input_error.innerHTML = '';
          date_input_error.innerHTML = '';
          location_input_error.innerHTML = '';
          project_link_input_error.innerHTML = '';
          category_input_error.innerHTML = '';


          status_submit.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>success</strong><br>${data.success}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;

        }
        if (data.title) {
          title_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>title error</strong><br>${data.title}
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
        if (data.client_name) {
          client_name_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>client name error</strong><br>${data.client_name}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.date) {
          date_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>date error</strong><br>${data.date}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.location_work) {
          location_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>location error</strong><br>${data.location_work}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.link) {
          project_link_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>project link error</strong><br>${data.link}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }
        if (data.category) {
          category_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>category error</strong><br>${data.category}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
        }

      } else {
        console.error(xhr.response);
      }
    }
  }
</script>

