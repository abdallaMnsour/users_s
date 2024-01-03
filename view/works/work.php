<?php

if (!isset($page_bool)) {
  header('location: ../');
  exit;
}

$query = "SELECT * FROM works WHERE user_id = '{$user['id']}'";

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
                <h1 class="modal-title fs-5" id="exampleModalLabel">delete work</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                are you sour you want delete this work ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-secondary" data-bs-dismiss="modal">Close</button>
                <button id="remove_serv" type="button" class="btn bg-danger" data-work="" onclick="remove_work(this)">Delete</button>
            </div>
        </div>
    </div>
</div>

<main>
    <section class="banner m-5">
        <a href="?manage=works&status=add" class="btn btn-primary mb-5">add work</a>
        <table class="table table-bordered table-hover border-dark">
            <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>title</th>
                <th>description</th>
                <th>client name</th>
                <th>date</th>
                <th>location</th>
                <th>project link</th>
                <th>category</th>
                <th>control</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($work = mysqli_fetch_assoc($query)) : ?>
                <tr id="row_<?= $work['id'] ?>">
                    <th><?= $work['id'] ?></th>
                    <th>
                        <img width="300" src="files_users/<?= $user['email'] ?>/work/<?= $work['image'] ?>" alt="image_work" data-name="<?= $work['image'] ?>" />
                    </th>
                    <th><?= $work['title'] ?></th>
                    <th><?= $work['description'] ?></th>
                    <th><?= $work['client_name'] ?></th>
                    <th><?= $work['date'] ?></th>
                    <th><?= $work['location'] ?></th>
                    <th><?= $work['project_link'] ?></th>
                    <th><?= $work['category'] ?></th>
                    <th>
                        <a href="?id=<?= $work['id'] ?>&manage=works&status=update&page=" class="btn d-block mb-1">update</a>

                        <!-- Button trigger modal -->
                        <button onclick="delete_work(<?= $work['id'] ?>)" type="button" class="btn bg-danger d-block w-100 p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

    function delete_work(id) {
        remove_serv.dataset.work = id;
    }

    function remove_work(element) {
        let modal = document.querySelector('.modal-backdrop.fade.show');
        let row = document.querySelector(`tr#row_${element.dataset.work}`);
        let img = document.querySelector(`tr#row_${element.dataset.work} th img`);
        let data = new FormData();
        data.append('work_id', element.dataset.work);
        data.append('image', img.dataset.name);


        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'functions/users/works/delete.php');
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