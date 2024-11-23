<?php
include_once './vendors/functions.php';
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';
auth();
//id	name	email	passowrd	position	image	phone	

$select = 'SELECT * from position';
$positoin = mysqli_query($conn, $select);

$select_rules = 'SELECT * from rules';
$rule = mysqli_query($conn, $select_rules);

$errors = [];

$message = null;
if (isset($_POST['send'])) {
    $name = filterValidation($_POST['name']);
    $rule_id = filterValidation($_POST['rule']);
    $email = filterValidation($_POST['email']);
    $position = filterValidation($_POST['position']);
    $passowrd = filterValidation($_POST['passowrd']);
    $phone = filterValidation($_POST['phone']);
    $hashPassowrd = sha1($passowrd);

    if (stringValidation($name)) {
        $errors[] = "Invalid Name";
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
        // No file uploaded or there was an error during upload
        $image_name = "fake.jpg";
    } else {
        //image code
        $image_name = rand(0, 100) . rand(0, 100) . $_FILES['image']['name'];
        //image temp name
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        if (fileSizeValidation($image_size)) {
            $errors[] = "The file is biger than 1 mega";
        }
        // $imageType = $_FILES['image']['type'];
        $imageType = substr($image_name, -3);
        if (typeFileValidation($imageType, 'jpg', 'png', 'JIF')) {
            $errors[] = "Invalid Image Type";
        }
    }
    
    $location = './upload/' . $image_name;
    $full_bath = url($location);

    $auth_id = $_SESSION['admin']['id'];
    if (empty($errors)) {
        move_uploaded_file($image_tmp, $location);
        $insert = "INSERT into admins values (NULL, '$name', '$email', '$hashPassowrd', '$position', '$full_bath', '$image_name' , '$phone', $auth_id, $rule_id )";
        $i = mysqli_query($conn, $insert);
        $message = getMessage($i, "Insert Admin Successfuly");
        redirect("create_admin.php?message=$message");
    }
}

if ($_SESSION['admin']['rule'] != 1) {
    redirect('error-404.php');
}


?>

<main id="main" class="main">
    <div class="container col-8">
        <div class="card">
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_GET['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- <?php $errors = [] ?> -->
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">Add new admin</h5>
                <!-- No Labels Form -->
                <form method="POST" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-6">
                        <input type="password" name="passowrd" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <select name="position" class="form-select">
                            <option selected>Postion</option>
                            <?php foreach ($positoin as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>;
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="rule" class="form-select">
                            <option selected>Rules</option>
                            <?php foreach ($rule as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                            <?php endforeach; ?>;
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="send" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End No Labels Form -->

            </div>
        </div>
    </div>


</main><!-- End #main -->





<?php

include_once './shared/footer.php';
include_once './shared/script.php';

?>