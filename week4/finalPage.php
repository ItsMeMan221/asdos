<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['cookies'])) {
        header('Location: 4.cookies.php');
    }
    if (isset($_POST['session'])) {
        session_destroy();
        header('Location: 5.session.php ');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
$head = "Final Page";
include './framework/bootstrap.php';
?>

<body>
    <form method="POST">
        <div class="container row">
            <div class="col">
                <button type="submit" class="btn btn-primary" name="cookies">Go back to Cookies</button>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary" name="session">Go back to Session</button>
            </div>
        </div>
    </form>
    <?php
    if (count($_SESSION) > 0) {
    ?>
        <div class="container">
            <h5>Id: <span><?= $_SESSION['id'] ?></span></h5>
            <h5>Email: <span><?= $_SESSION['email'] ?></span></h5>
            <h5>Password: <span><?= $_SESSION['password'] ?></span></h5>
        </div>
    <?php
    }
    ?>
</body>

</html>