<?php
session_start();
require_once './config/dbcon.php';
require_once './functions/cleaner.php';
$email = $password = "";
$emailErr = $passwordErr = "";
$isValid = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        $emailErr = "Mohon isi field email";
        $isValid = 0;
    } else {
        $email = cleaner($_POST['email']);
    }
    if (empty($_POST['password'])) {
        $passwordErr = "Mohon isi field password";
        $isValid = 0;
    } else {
        $password = cleaner($_POST['password']);
    }

    if ($isValid == 1) {
        // TODO 1 : Bila validasi berhasil maka mulai proses login
        $queryLogin = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $queryLogin->bind_param("s", $email);
        $queryLogin->execute();
        $resQueryLogin = $queryLogin->get_result();
        $numQueryLogin = $resQueryLogin->num_rows;

        if ($numQueryLogin > 0) {
            $dataLogin = $resQueryLogin->fetch_assoc();
            $verifPassword = password_verify($password, $dataLogin['password']);

            if ($verifPassword) {
                header("Location: ./index.php?page=dashboard");
            } else {
                echo "<script>alert('Credential salah, gagal login')</script>";
            }
        } else {
            echo "<script>alert('Email belum terdaftar')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
$head = "LOGIN PAGE";
include './framework/bootstrap.php';
include './framework/sweetalert.php';
?>

<body class="back-color">
    <section class="vh-100 gradint">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-white text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login Page</h2>
                                <p class="text-dark-50 mb-5 text-a mt-3">Welcome to <span class="text-bold">TechX
                                    </span>please enter your <span class="text-bold">email</span> along with your <span
                                        class="text-bold">Password </span>!</p>
                                <form method="POST" id="loginForm">
                                    <div class="form-outline form-dark mb-4">
                                        <label class="form-label" for="email">Email Address</label>
                                        <input type="text" name="email" id="email"
                                            class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="emailError"></small>

                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="passError"></small>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-outline-dark btn-lg px-5"
                                        value="Submit">LOG-IN</button>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="index.php?page=register"
                                        class="text-dark-50 fw-bold">Sign Up</a>
                                </p>
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

    .text-bold {
        font-weight: 800;
    }
</style>