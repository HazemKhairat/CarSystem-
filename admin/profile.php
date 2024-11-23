<?php
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';

auth();
$adminID = $_SESSION['admin']['id'];
$admin = "SELECT * FROM `admin_data` where id = $adminID";
$admin_data = mysqli_query($conn, $admin);
$row = mysqli_fetch_assoc($admin_data);

//id	name	email	passowrd	position	image	phone	

$select = 'SELECT * from position';
$positoin = mysqli_query($conn, $select);

$select_rules = 'SELECT * from rules';
$rule = mysqli_query($conn, $select_rules);


$message = null;
if (isset($_POST['update'])) {
  $rule_id = $_POST['rule'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $position = $_POST['position'];

  if (empty($_FILES['image']['name'])) {
    $image_name = $row['image_name'];
    $full_bath = $row['image'];
  } else {
    $old_image = $row['image_name'];
    unlink("./upload/$old_image");
    //image code
    $image_name = rand(0, 100) . rand(0, 100) . $_FILES['image']['name'];
    //image temp name
    $image_tmp = $_FILES['image']['tmp_name'];
    $location = 'upload/' . $image_name;
    move_uploaded_file($image_tmp, $location);
    $full_bath = url('') . $location;
    $phone = $_POST['phone'];
    $_SESSION['admin']['image'] = $full_bath;
  }

  // $auth_id = $_SESSION['admin']['id'];
  $update = "UPDATE admins SET name ='$name', email = '$email', position = '$position', image = '$full_bath', image_name = '$image_name' , phone = '$phone', rule_id = $rule_id where id = $adminID";
  $i = mysqli_query($conn, $update);
  $message = getMessage($i, "Update Admin Successfuly");
  redirect("profile.php?message=$message");
}

if (isset($_POST['change_password'])) {
  // current password --------------
  $password = $_POST['password'];
  $hash_password_input = sha1($password);
  $database_password = $row['password'];
  // new password ------------------
  $newpassword = $_POST['newpassword'];
  // ensure new password -----------
  $renewpassword = $_POST['renewpassword'];
  if ($hash_password_input == $database_password) {
    if ($newpassword == $renewpassword) {
      $hash_newpassword = sha1($newpassword);
      $query = "UPDATE admins SET password = '$hash_newpassword' where id = $adminID";
      $update = mysqli_query($conn, $query);
      $message = getMessage($update, "Update Password Successfuly");
      redirect("profile.php?message=$message");
    } else {
      $message = getMessage($update, "Doesn't Match Password");
      redirect("profile.php?message=$message");
    }
  } else {
    $message = getMessage($update, "Wrong Password, Try Again");
    redirect("profile.php?message=$message");
  }
}



?>


<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
     
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $_GET['message'] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif ?>
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= $row['image'] ?>" alt="Profile" class="rounded-circle">
              <h2><?= $row['name'] ?></h2>
              <h3><?= $row['position_name'] ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                    temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem
                    eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $row['name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?= $row['phone'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Postion</div>
                    <div class="col-lg-9 col-md-8"><?= $row['position_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rule</div>
                    <div class="col-lg-9 col-md-8"><?= $row['title'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Description</div>
                    <div class="col-lg-9 col-md-8"><?= $row['description'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Added by parent</div>
                    <div class="col-lg-9 col-md-8"><?= $row['parent_id'] . " : " . $row['parent_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $row['email'] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?= $row['image'] ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" name="image" accept="image/*">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" value="<?= $row['name'] ?>" type="text" class="form-control" id="fullName"
                          value="Kevin Anderson">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input value="<?= $row['email'] ?>" type="email" name="email" class="form-control"
                          id="email"></input>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone" value="<?= $row['phone'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Postion</label>
                      <select name="position" class="form-select">
                        <option selected>Postion</option>
                        <?php foreach ($positoin as $item): ?>
                          <?php if ($item['id'] == $row['position_id']): ?>
                            <option selected value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                          <?php endif; ?>
                          <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php endforeach; ?>;
                      </select>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Rules</label>
                      <select name="rule" class="form-select">
                        <option selected>Rules</option>
                        <?php foreach ($rule as $item): ?>
                          <?php if ($item['id'] == $row['rule_id']): ?>
                            <option selected value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                          <?php endif; ?>
                          <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                        <?php endforeach; ?>;
                      </select>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="USA">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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