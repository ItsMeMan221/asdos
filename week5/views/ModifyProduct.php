<?php
// require_once './config/dbcon.php';
require_once './functions/cleaner.php';
$productName = $brand = $releaseYear = $price = "";
$productErr = $brandErr = $releaseYearErr = $priceErr =  $fileErr = "";
$isValid = 1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ((isset($_GET['id']) && is_uploaded_file($_FILES['productImage']['tmp_name'])) || !isset($_GET['id'])) {

        $rand_name = md5(uniqid(mt_rand(), true));

        $org_name = $save_dir . basename($_FILES["productImage"]["name"]);

        $file_type = strtolower(pathinfo($org_name, PATHINFO_EXTENSION));

        $rand_name .= "." . $file_type;

        $target_file = $save_dir . $rand_name;
    }
    if (isset($_POST['submit'])) {

        // Product Name Validation
        if (empty($_POST['productName'])) {
            $isValid = 0;
            $productErr = "Mohon isi field nama product";
        } else {
            $productName = cleaner($_POST['productName']);
        }

        // Brand Validation
        if (empty($_POST['brand'])) {
            $isValid = 0;
            $brandErr = "Pilih salah satu brand";
        } else {
            $brand = cleaner($_POST['brand']);
        }

        // Release Year Validation
        if (empty($_POST['releaseYear'])) {
            $isValid = 0;
            $releaseYearErr = "Mohon isi field tahun rilis";
        } else {
            $releaseYear = cleaner($_POST['releaseYear']);
        }

        // Price Validation
        if (empty($_POST['price'])) {
            $isValid = 0;
            $priceErr = "Mohon isi field harga";
        } else {
            $price = cleaner($_POST['price']);
        }

        // File Validation 

        if (!isset($_GET['id'])) {
            if (!is_uploaded_file($_FILES['productImage']['tmp_name'])) {
                $isValid = 0;
                $fileErr = "Mohon upload gambar produk";
            } else {
                if (getimagesize($_FILES['productImage']['tmp_name']) === false) {
                    $isValid = 0;
                    $fileErr = "File tidak dalam bentuk image";
                }
            }
        } else if (isset($_GET['id']) && is_uploaded_file($_FILES['productImage']['tmp_name'])) {
            if (getimagesize($_FILES['productImage']['tmp_name']) === false) {
                $isValid = 0;
                $fileErr = "File tidak dalam bentuk image";
            }
        }


        // Bila valid maka mulai proses insert/update!
    }
}

?>

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
        <form method="POST" enctype="multipart/form-data">
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="productName">Product Name</label>
                <input type="text" name="productName" id="productName" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="brand">Brand Name</label>
                <select class="form-select form-select-lg" name="brand">
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
                <img class="prev-img" id="prev-img">
            </div>
            <div class="form-outline form-dark mb-4 text-center">
                <input type="submit" name="submit" class="btn btn-outline-success px-5 py-2" />
            </div>
        </form>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#productImage').on('change', function() {
            const file = document.getElementById("productImage").files[0];
            const image = URL.createObjectURL(file);
            $('#prev-img').attr('src', image);
        })
    })
</script>
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

    .prev-img {
        width: 200px;
        height: 200px;
    }
</style>