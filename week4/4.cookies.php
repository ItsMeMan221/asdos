<?php
$email = $password = $rememberMe = "";
$cookiesEmail = $cookiesPassword = $cookiesRemember = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rememberMe = $_POST['rememberMe'];

        if ($rememberMe == "1") {
            $cookiesEmail  = $email;
            $cookiesPassword = $password;
            $cookiesRemember = $rememberMe;
            setcookie("email", $cookiesEmail, time() + (86400 * 30), "/");
            setcookie("password", $cookiesPassword, time() + (86400 * 30), "/");
            setcookie("isRemember", $cookiesRemember, time() + (86400 * 30), "/");
        }
        header('Location: finalPage.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<?php
$head = "Cookies";
include './framework/bootstrap.php';
?>

<body>
    <h1 class="text-center mt-3">Cookies</h1>
    <div class="container">
        <form method="POST" action="">
            <div class="row mb-3 mt-5">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <?php
                    if (isset($_COOKIE['email'])) {
                    ?>
                        <input type="text" class="form-control" id="email" placeholder="Input your email" name="email" value="<?= $_COOKIE['email'] ?>">
                    <?php
                    } else {
                    ?>
                        <input type="text" class="form-control" id="email" placeholder="Input your email" name="email">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <label for="email" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-8">
                    <?php
                    if (isset($_COOKIE['password'])) {
                    ?>
                        <input type="password" class="form-control" id="password" placeholder="Input your password" name="password" value="<?= $_COOKIE['password'] ?>">
                    <?php
                    } else {
                    ?>
                        <input type="password" class="form-control" id="password" placeholder="Input your password" name="password">
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="form-check">
                    <?php
                    if (isset($_COOKIE['isRemember']) == '1') {
                    ?>
                        <input class="form-check-input" type="checkbox" value="1" id="checkbox" name="rememberMe" checked>
                    <?php
                    } else {
                    ?>
                        <input class="form-check-input" type="checkbox" value="1" id="checkbox" name="rememberMe">
                    <?php
                    }
                    ?>

                    <label class="form-check-label" for="flexCheckDefault">
                        Remember Me
                    </label>
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>