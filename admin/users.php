<?php
include 'includes/headerAndSidebar.php';
require_once 'functions/connect.php';
?>

<div class="main-content">

  <div class="page-content">

    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php if (isset($_SESSION['error_update']) && $_SESSION['error_update'] == 'no_user_id') : ?>
                <div class="alert alert-danger alert-dismissible">
                  <strong><?= $_SESSION['error_update']?>!</strong> : no id number :(<br>You have entered the edit page in a wrong way. If the problem persists please <a href="mailto:a.mansour.code@gmail.com">contact with developer</a>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                unset($_SESSION['error_update']);
                endif;
              ?>
              <?php if (isset($_SESSION['error_update']) && $_SESSION['error_update'] == 'no_user_database') : ?>
                <div class="alert alert-danger alert-dismissible">
                  <strong><?= $_SESSION['error_update']?>!</strong> : wrong id number :(<br>id is wrong please try again, If the problem persists please <a href="mailto:a.mansour.code@gmail.com" >contact with developer</a>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                unset($_SESSION['error_update']);
                endif;
              ?>
              <h4 class="card-title">Alternative Pagination</h4>
              <p class="card-title-desc">
                The default page control presented by DataTables (forward and backward buttons with up to 7 page numbers in-between)
                is fine for most situations, but there are cases where you may wish to customise the options presented to the end
                user.
              </p>

              <div id="alternative-page-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <div class="row">
                  <div class="col-sm-12" style="overflow: auto;">
                    <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="alternative-page-datatable_info" style="width: 937px;">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 142px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">id</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 219px;" aria-label="Position: activate to sort column ascending">username</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">email</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">phone</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">gender</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">image</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">priv</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">country</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">county</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 84px;" aria-label="Salary: activate to sort column ascending">city</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 45px;" aria-label="Age: activate to sort column ascending">address_1</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 95px;" aria-label="Start date: activate to sort column ascending">address_2</th>
                          <th class="sorting" tabindex="0" aria-controls="alternative-page-datatable" rowspan="1" colspan="1" style="width: 95px;" aria-label="Start date: activate to sort column ascending">control</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $query = "SELECT * FROM users";
                        $u = mysqli_query($conn, $query);
                        while ($user = mysqli_fetch_assoc($u)) :
                          if ($user['id'] != $admin['id']) :
                        ?>
                            <!-- Modal -->
                            <div class="modal fade" id="delete_<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">delete <?= $user['priv'] == 0 ? '<b>user</b> ' . $user['username'] : '<b>admin</b> ' . $user['username'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    when you click "yes" you well remove <?= $user['username'] ?> from your website
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="functions/users/delete.php" method="post">
                                      <button type="submit" class="btn btn-danger" name="remove" value='<?= $user['id'] ?>'>Yes</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <tr class="odd">
                              <td class="sorting_1 dtr-control"><?= $user['id'] ?></td>
                              <td><?= $user['username'] ?></td>
                              <td><?= $user['email'] ?></td>
                              <td><?= $user['phone'] ?></td>
                              <td><?= $user['gender'] == 0 ? 'male' : 'female' ?></td>
                              <td><img class="avatar-md rounded-circle" style="height: 40px;width:40px" src="../img/users/<?= $user['image'] ?>" alt="user_img"></td>
                              <td><?= $user['priv'] == 0 ? 'user' : 'admin' ?></td>
                              <td><?= $user['country'] ?></td>
                              <td><?= $user['county'] ?></td>
                              <td><?= $user['city'] ?></td>
                              <td><?= $user['address_1'] ?></td>
                              <td><?= $user['address_2'] ?></td>
                              <td>
                                <a href="functions/users/update.php?user=<?= $user['id'] ?>" class="btn btn-success">Update</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_<?= $user['id'] ?>">
                                  Delete
                                </button>

                              </td>
                            </tr>
                          <?php endif; ?>
                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div> <!-- end card body-->
          </div> <!-- end card -->
        </div><!-- end col-->
      </div>
      <!-- end row-->

    </div> <!-- container-fluid -->
  </div>
</div>
<!-- Right Sidebar -->
<div class="right-bar">
  <div data-simplebar="init" class="h-100">
    <div class="simplebar-wrapper" style="margin: 0px;">
      <div class="simplebar-height-auto-observer-wrapper">
        <div class="simplebar-height-auto-observer"></div>
      </div>
      <div class="simplebar-mask">
        <div class="simplebar-offset" style="right: -17px; bottom: 0px;">
          <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
            <div class="simplebar-content" style="padding: 0px;">
              <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                  <i class="mdi mdi-close noti-icon"></i>
                </a>
              </div>

              <!-- Settings -->
              <hr class="mt-0">
              <h6 class="text-center mb-0">Choose Layouts</h6>

              <div class="p-4">
                <div class="mb-2">
                  <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                </div>

                <div class="form-check form-switch mb-3">
                  <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked="">
                  <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                  <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsstyle="assets/css/bootstrap-dark.min.css" data-appstyle="assets/css/app-dark.min.css">
                  <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                  <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                </div>
                <div class="form-check form-switch mb-5">
                  <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appstyle="assets/css/app-rtl.min.css">
                  <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>


              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="simplebar-placeholder" style="width: auto; height: 811px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
      <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
      <div class="simplebar-scrollbar" style="height: 105px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
    </div>
  </div> <!-- end slimscroll-menu-->
</div>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<?php
include 'includes/footer.php';
?>