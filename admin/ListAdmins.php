<?php
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';
auth(2);
$select = "SELECT * from admins";
$admins = mysqli_query($conn, $select);


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $select2 = "SELECT * from admins where id = $id";
  $admins2 = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($admins2);
  $image = $row['image_name'];
  unlink("./upload/$image");
  $delete = "DELETE from admins where id = $id";
  $delete2 = mysqli_query($conn, $delete);
  redirect("ListAdmins.php");

}



?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Admin Page</h1>
    
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">

          <div class="card-body">

            <h5 class="card-title">List Admins <a class="btn btn-primary float-end" href="create_admin.php">Add new</a>
            </h5>
            <!-- Table with stripped rows -->
            <table class="table ">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">name</th>
                  <th scope="col">email</th>
                  <th scope="col">position</th>
                  <th colspan="2" scope="col">Actions</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($admins as $item): ?>
                  <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['position'] ?></td>
                    <td> <a href="<?= url('ListAdmins.php?delete=') . $item['id'] ?>"><i
                          class='text-danger bx bxs-trash'></i></a> Delete</td>
                    <td><a href="<?= url('ViewAdmins.php?view=') . $item['id'] ?>"><i class='text-info bx bx-show' ></i></a> View</td>

                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>


</main><!-- End #main -->





<?php

include_once './shared/footer.php';
include_once './shared/script.php';

?>