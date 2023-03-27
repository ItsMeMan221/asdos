<?php
/* 
Best Practice on Handling form
*/
function secureForm($str)
{
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);

    return $str;
}

$email = $password = "";
$passRegex = '';
$emailErr = $passwordErr = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $emailErr = "Masukkan email anda!";
        } else {
            // var_dump($_POST['email']);
            // echo "<br>";
            // var_dump(secureForm($_POST['email']));
            // exit();
            $email = secureForm($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = "";
                $emailErr = "Format email belum benar";
            } else {
                $emailErr = "";
            }
        }
        if (empty($_POST['password'])) {
            $passwordErr = "Masukkan password anda!";
        } else {
            $password = secureForm($_POST['password']);
            if  (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $password)) {
                $password = "";
                $passwordErr = "Password harus mengandung 1 Uppercase letter, 1 lowercase letter dan 1 angka";
            }
            else {
                $passwordErr ="";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .error {
        color: red;
        font-size: 12px;
    }
</style>
<?php
$head = 'FORM COMPLETE';
include './framework/bootstrap.php'
    ?>

<body>
    <h1 class="text-center mt-2">FORM COMPLETE</h1>
    <form method="POST" action="" class="container">
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
        <div class="row mb-3 mt-3">
            <input type="submit" class="col mx-5 mt-4 btn btn-primary" name="submit">
        </div>
    </form>
    <div>
        <h1>Your Input</h1>
        <h5>Email: <?= $email ?></h5>
        <h5>Password: <?= $password ?></h5>
    </div>
</body>

</html>