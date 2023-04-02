<?php


function secureForm($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

$email = $password = $username = $description = "";
$passRegex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/';

$emailErr = $passwordErr = $usernameErr = $descriptionErr = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $username = secureForm($_POST['username']);
        $description = secureForm($_POST['description']);
        if (empty($_POST['email'])) {
            $emailErr = "Mohon isi email anda";
        } else {
            $email = secureForm($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format email belum sesuai";
            } else {
                $emailErr = "";
            }
        }
        if (empty($_POST['password'])) {
            $passwordErr = "Mohon isi password anda";
        } else {
            $password = secureForm($_POST['password']);
            if (!preg_match($passRegex, $password)) {
                $passwordErr = "Gunakan 1 uppercase , lowercase , dan angka";
            } else {
                $passwordErr = "";
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php
include './framework/bootstrap.php'
    ?>
<style>
    .error {
        color: red;
        font-size: 12px;
    }
</style>

<body>
    <form method="POST" action="" class="container mx-auto">
        <div class="row mb-3 mt-5">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="email" placeholder="Input your email" name="email"
                    value="<?= $email ?>">
            </div>
            <div class="col-sm-3">
                <span class="error">
                    <?= $emailErr ?>
                </span>
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="password" placeholder="Input your password" name="password"
                    value="<?= $password ?>">
            </div>
            <div class="col-sm-3">
                <span class="error">
                    <?= $passwordErr ?>
                </span>
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="username" placeholder="Input your username" name="username"
                    value="<?= $username ?>">
            </div>
            <div class="col-sm-3">
                <span class="error">
                    <?= $usernameErr ?>
                </span>
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="description" class="col-sm-2 col-form-label">description</label>
            <div class="col-sm-7">
                <textarea type="text" class="form-control" id="description" placeholder="Input your description"
                    name="description" value=""> <?= $description ?></textarea>
            </div>
            <div class="col-sm-3">
                <span class="error">
                    <?= $descriptionErr ?>
                </span>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <input type="submit" class="col mx-5 mt-4 btn btn-primary" name="submit">
        </div>
    </form>


    <h1>Your Input: </h1>
    <?php
    if ($emailErr == "") {

        ?>
        <h5>Email: <span>
                <?= $email ?>
            </span></h5>
    <?php } ?>

    <?php if ($passwordErr == "") { ?>
        <h5>password: <span>
                <?= $password ?>
            </span></h5>
    <?php } ?>
    <h5>username: <span>
            <?= $username ?>
        </span></h5>
    <h5>description: <span>
            <?= $description ?>
        </span></h5>
</body>

</html>