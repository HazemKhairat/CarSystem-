<?php 
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';
auth();

//id	name	email	passowrd	position	image	phone	
$select = 'SELECT * from position';
$data = mysqli_query($conn, $select);
?>

<main id="main" class="main">
<div class="pagetitle">
      <h1>Position Page</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">

            <div class="card-body">

              <h5 class="card-title" >List Positions <a class="btn btn-primary float-end" href="create_position.php" >Add new</a>
              </h5>
              <!-- Table with stripped rows -->
              <!-- datatable -->
              <table class="table ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($data as $item): ?>
                    <tr>
                      <td><?= $item['id'] ?></td>
                      <td><?= $item['name']?></td>
                    </tr>
                  <?php endforeach;?>
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