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
    $country = $_POST['country'];
    if($name != ''){
        $insert = "INSERT into brand values (NULL, '$name', '$country')";
        $i = mysqli_query($conn, $insert);
        $message = getMessage($i, "Insert Brand Successfuly");
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
                <h5 class="card-title">Add New Brand</h5>

                <!-- No Labels Form -->
                <form method="POST" class="row g-3">
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control" placeholder="Your Brand">
                    </div>
                    <div class="col-md-12">
                        <select name="country" class="form-select" placeholder="Your Country">
                                <option selected >Choose Country</option>
                                <option value="China">China</option>
                                <option value="Egypt">Egypt</option>
                                <option value="England">England</option>
                                <option value="France">France</option>
                                <option value="Amirca">Amirca</option>
                                <option value="Italia">Itailia</option>
                                <option value="Moroco">Moroco</option>
                                <option value="Nemsa">Nemsa</option>
                                <option value="Brazil">Brazil</option>
                        </select>
                        <!-- <input type="text" name="country" class="form-control" placeholder="Your Country"> -->
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