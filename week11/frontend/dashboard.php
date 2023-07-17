<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../static/head.php'; ?>

<body>
    <?php
    if (isset($_SESSION['AUTH'])) {
        if ($_SESSION['AUTH'] == 'true') {

    ?>
            <h1>Ini halaman dashboard</h1>

        <?php     }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login first!',
                text: 'Anda belum login, mohon login terlebih dahulu',
            }).then(() => {
                document.location.href = '../index.php';
            })
        </script>
    <?php
    }
    ?>
</body>

</html>