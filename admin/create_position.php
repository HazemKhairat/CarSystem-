<?php

include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './vendors/config.php';
auth();

//id	name	email	passowrd	position	image	phone	
$message = null;
if(isset($_POST['send'])){
    $name = $_POST['name'];
    if($name != ''){
        $insert = "INSERT into position values (NULL, '$name')";
        $i = mysqli_query($conn, $insert);
        $message = getMessage($i, "Insert Position Successfuly");
    }
    else{
        $message = null;
    }
}
?>

<main id="main" class="main">
    <div class="container col-8">
        <div class="card">
            <?php if($message != null) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>
            <div class="card-body">
                <h5 class="card-title">Add new position</h5>

                <!-- No Labels Form -->
                <form method="POST" class="row g-3">
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control" placeholder="Your Postion">
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