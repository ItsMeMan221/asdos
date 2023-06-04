<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // $email = $_REQUEST['email'];
    // $password = $_REQUEST['password'];

    /*
    Untuk mendapatkan user input melalui post method dapat digunakan
    keyword $_POST
    */
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['submit'])) {
        if (empty($email)) {
            echo "Email is empty! <br>";
        } else if (!empty($email)) {
            echo "<h5> Email is :" . $email . "</h5>";
        }
        if (empty($password)) {
            echo "Password is empty <br>";
        } else if (!empty($password)) {
            echo "<h5> Password is :" . $password . "</h5>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php
$head = 'REQUEST';
include './framework/bootstrap.php'
    ?>

<body>
    <h1 class="text-center mt-2">REQUEST</h1>
    <form method="POST" action="" class="container">
        <div class="row mb-3 mt-5">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="Input your email" name="email">
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="Input your password" name="password">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <input type="submit" class="col mx-5 mt-4" name="submit">
        </div>
    </form>
</body>

</html>