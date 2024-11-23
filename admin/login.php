<?php
include_once './vendors/config.php';
include_once './shared/head.php';
if(isset($_GET['logout'])){
  session_unset();
  session_destroy();
}
$message = null;
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hash = sha1($password);
  $select = "SELECT * FROM `admins` WHERE email = '$email' and password = '$hash'";
  $admin = mysqli_query($conn, $select);
  $numRows = mysqli_num_rows($admin);

  $admin_data = mysqli_fetch_assoc($admin);


  if ($numRows == 1) {
    $_SESSION['admin'] = [
      'id' => $admin_data['id'],
      'email' => $admin_data['email'],
      'name' => $admin_data['name'],
      'image' => $admin_data['image'],
      'rule' => $admin_data['rule_id'],
    ];
    redirect('/');
  } else {
    $message = 'False Login';
  }
}
print_r($_SESSION);
?>


<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
              </a>
            </div><!-- End Logo -->
            <div class="card">
              <?php if ($message != null): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $message ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php endif ?>
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your Email & password to login</p>
                </div>

                <form class="row g-3 needs-validation" method="post" novalidate>

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" name="email" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Please enter your Email.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourpassword" class="form-label">password</label>
                    <input type="password" name="password" class="form-control" id="yourpassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              Designed by <a href="https://bootstrapmade.com/">Hazem Khairat</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->


<?php

include_once './shared/footer.php';
include_once './shared/script.php';

?>