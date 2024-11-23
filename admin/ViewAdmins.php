<?php 
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';
auth();

if(isset($_GET['view'])){
  $id = $_GET['view'];
  $select = "SELECT * from admins where id = $id";
  $admins = mysqli_query($conn, $select);
  // $row = mysqli_fetch_assoc($admins);
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
            <img src="<?= $row['image'] ?>" class="img-top" alt="">
            <div class="card-body">
              <h5 class="card-title" >List Admin</h5>
              <hr>
              <!-- <h6>Name: <?= $row['name'] ?></h6> -->
              <!-- Table with stripped rows -->
              <table class="table datatable">
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
                <?php foreach($admins as $item) :?>
                  <tr>
                      <th><?= $item['id'] ?></th>
                      <th><?= $item['name'] ?></th>
                      <th><?= $item['email'] ?></th>
                      <th><?= $item['position'] ?></th>
                      <th><a href="<?= url('ListAdmins.php?delete=') . $item['id'] ?>"><i class='text-danger bx bxs-trash'></i></a></th>
                      <th><a href="<?= url('ListAdmins.php?view=') . $item['id'] ?>"><i class='text-info bx bx-show' ></i></a></th>

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