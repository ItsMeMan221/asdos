<?php
// require_once './config/dbcon.php';
require_once './functions/cleaner.php';

// Initialize all variable
$email = $username = $password = "";
$regex = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
$passHash = "";
$emailErr = $usernameErr = $passwordErr = "";
$isValid = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['signUp'])) {

        // Validasi Email
        if (empty($_POST['email'])) {
            $emailErr = 'Mohon isi field Email';
            $isValid = 0;
        } else {
            $email = cleaner($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format email belum sesuai";
                $isValid = 0;
            } else {
                // TODO 1: Check if email is exist or not
            }
        }

        // Validasi Username
        if (empty($_POST['username'])) {
            $usernameErr = "Mohon isi field username";
            $isValid = 0;
        } else {
            $username = cleaner($_POST['username']);
            if (strlen($username) < 5) {
                $usernameErr = "Panjang username harus lebih dari 5 karakter";
                $isValid = 0;
            }
        }

        // Validasi Password 
        if (empty($_POST['password'])) {
            $passwordErr = "Mohon isi field password";
            $isValid = 0;
        } else {
            $password = cleaner($_POST['password']);
            if (!preg_match($regex, $password)) {
                $passwordErr = "Password paling tidak memiliki 8 huruf, 1 huruf besar dan 1 digit angka";
                $isValid = 0;
            }
        }

        // Bila Valid 
        if ($isValid == 1) {
            $passHash  = password_hash($password, PASSWORD_BCRYPT);
            // TODO 2 : Insert to database
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$head = "REGISTER PAGE";
include './framework/bootstrap.php';
include './framework/sweetalert.php';
?>

<body>
    <section class="h-100 back-color">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4 bc-contain">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block ">
                                <img src="./image/registerStock.jpg" class="img-fluid" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-dark">
                                    <h3 class="text-uppercase">Register</h3>
                                    <div class="col-md-4 col-sm-2 col-xs-2 col-6 mb-5">
                                        <hr class="hr-kontak">
                                    </div>
                                    <form method="POST">
                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="email" id="email" class="form-control form-control-lg" value="<?= $email ?>" />
                                                <small class="text-danger" id="emailError"><?= $emailErr ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-5">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username" id="username" class="form-control form-control-lg" value="<?= $username ?>" />
                                                <small class="text-danger" id="usernameError"><?= $usernameErr ?></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3 mt-5">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" id="password" class="form-control form-control-lg" value="<?= $password ?>" />
                                                <small class="text-danger" id="passwordError"><?= $passwordErr ?></small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end pt-3 mt-5">
                                            <button type="submit" class="btn btn-success btn-lg ms-2 col-md-3" id="btn-kirim" name="signUp">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<style>
    .back-color {
        background-color: #EEEEEE;
    }
</style>