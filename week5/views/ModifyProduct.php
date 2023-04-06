<!DOCTYPE html>
<html lang="en">

<?php
if (isset($_GET['id'])) {
    $head = "Edit Product";
} else {
    $head = "Add Product";
}

include './framework/bootstrap.php';
include './framework/sweetalert.php';
?>

<body class="back-color">
    <?php
    include './components/navbar.php';
    ?>
    <div class="container mt-5 pt-4">
        <h1 class="fw-bold text-center"><?= $head ?></h1>
        <form method="POST">
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="productName">Product Name</label>
                <input type="text" name="productName" id="productName" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="brand">Brand Name</label>
                <select class="form-select form-select-lg">
                    <option value="1">One</option>
                </select>
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="releaseYear">Release Year</label>
                <input type="number" name="releaseYear" id="releaseYear" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="productImage">Product Image</label>
                <input type="file" name="productImage" id="productImage" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productImageError"></small>
            </div>
            <div class="form-outline form-dark mb-4 text-center">
                <input type="submit" name="submit" class="btn btn-outline-success px-5 py-2" />
            </div>
        </form>
    </div>
</body>

</html>
<style>
    .back-color {
        background-color: #EEEEEE;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>