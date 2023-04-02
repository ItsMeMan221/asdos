<?php
session_start();
$email = $password = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $rand_id = md5(uniqid(mt_rand(), true));
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Set session var 
        $_SESSION['id'] = $rand_id;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        header('Location: finalPage.php ');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
$head = "SESSION";
include './framework/bootstrap.php';
?>

<body>
    <h1 class="text-center mt-3">Session</h1>
    <div class="container">
        <form method="POST" action="">
            <div class="row mb-3 mt-5">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" placeholder="Input your email" name="email">
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <label for="email" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" placeholder="Input your password" name="password">
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>