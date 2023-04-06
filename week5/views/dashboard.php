<!DOCTYPE html>
<html lang="en">

<?php
$head = "DASHBOARD";
include './framework/bootstrap.php';
include './framework/sweetalert.php';
?>

<body class="back-color">
    <?php
    include './components/navbar.php';
    ?>
    <div class="container mt-5 pt-4 text-center">
        <h1 class="fw-bolder">Inventory System</h1>
        <table class="table caption-top table-responsive mt-4 table-light">
            <caption><a href="./index.php?page=product" class="btn btn-outline-success"><i class="bi bi-plus-lg me-2"></i>Add Product</a></caption>
            <thead class="table-light">
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- TODO 1 : LOOP DATA -->
                <tr>
                    <th scope="row">1</th>
                    <td>Hyperx Pulsefire Haste Wireless Gaming</td>
                    <td>HyperX</td>
                    <td>2023</td>
                    <td>20000000</td>
                    <td>Image</td>
                    <td><a href="./index.php?page=product&id=1" class="btn btn-outline-warning px-3 py-1"><i class="bi bi-pencil me-2"></i>Edit</a></td>
                    <td><a href="#" class="btn btn-outline-danger px-3 py-1"><i class="bi bi-trash2-fill me-2"></i>Delete</a></td>
                </tr>

                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

<style>
    .back-color {
        background-color: #EEEEEE;
    }
</style>