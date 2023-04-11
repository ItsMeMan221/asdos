<?php
require_once './config/dbcon.php';
require_once './functions/cleaner.php';
$productName = $brand = $releaseYear = $price = "";
$productErr = $brandErr = $releaseYearErr = $priceErr = $fileErr = "";
$isValid = 1;
$save_dir = 'uploads/';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $queryGetProduct = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $queryGetProduct->bind_param("i", $productId);
    if ($queryGetProduct->execute()) {
        $resGetProd = $queryGetProduct->get_result();
        $rowProduct = $resGetProd->fetch_assoc();

        $productName = $rowProduct['product_name'];
        $brand = $rowProduct['brand_id'];
        $releaseYear = $rowProduct['release_year'];
        $price = $rowProduct['price'];
        $productImage = $rowProduct['product_image'];
    }
}
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

        // Proses insert
        if (!isset($_GET['id']) && $isValid == 1) {

            $queryInsert = $conn->prepare("INSERT INTO products (brand_id, product_name, release_year, price, product_image) 
                                            VALUES (? , ?, ? , ? , ? )");
            $queryInsert->bind_param("isiis", $brand, $productName, $releaseYear, $price, $target_file);

            if ($queryInsert->execute()) {
                if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target_file)) {
                    header("Location: ./index.php?page=dashboard");
                }
            } else {
                echo "<script>alert('Gagal menambahkan produk')</script>";
            }
        } else if (isset($_GET['id']) && $isValid == 1) {
            if (!is_uploaded_file($_FILES['productImage']['tmp_name'])) {
                $queryUpdate = $conn->prepare("UPDATE products SET product_name = ?, brand_id = ?, release_year = ?, price = ? WHERE id = ?");
                $queryUpdate->bind_param("siiii", $productName, $brand, $releaseYear, $price, $productId);
                if ($queryUpdate->execute()) {
                    header("Location: ./index.php?page=dashboard");
                } else {
                    echo "<script>alert('Gagal update produk')</script>";
                }
            } else {
                $queryUpdate = $conn->prepare("UPDATE products SET product_name = ?, brand_id = ?, release_year = ?, price = ?, product_image = ? WHERE id = ?");
                $queryUpdate->bind_param("siiisi", $productName, $brand, $releaseYear, $price, $target_file, $productId);
                if ($queryUpdate->execute()) {
                    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target_file)) {
                        unlink($productImage);
                        header("Location: ./index.php?page=dashboard");
                    }
                } else {
                    echo "<script>alert('Gagal update produk')</script>";
                }
            }
        }
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
        <h1 class="fw-bold text-center">
            <?= $head ?>
        </h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="productName">Product Name</label>
                <input type="text" name="productName" id="productName" class="form-control form-control-lg"
                    value="<?= $productName ?>" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="brand">Brand Name</label>
                <select class="form-select form-select-lg" name="brand">
                    <?php
                    $queryGetBrand = $conn->query("SELECT * FROM brands");
                    while ($data = $queryGetBrand->fetch_assoc()) {
                        if ($brand == $data['id']) {
                            ?>
                            <option value="<?= $data['id'] ?>" selected> <?= $data['description'] ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?= $data['id'] ?>"> <?= $data['description'] ?></option>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </select>
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="releaseYear">Release Year</label>
                <input type="number" name="releaseYear" id="releaseYear" class="form-control form-control-lg"
                    value="<?= $releaseYear ?>" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control form-control-lg"
                    value="<?= $price ?>" />
                <small class="text-danger ml-5" id="productError"></small>
            </div>
            <div class="form-outline form-dark mb-4">
                <label class="form-label" for="productImage">Product Image</label>
                <input type="file" name="productImage" id="productImage" class="form-control form-control-lg" />
                <small class="text-danger ml-5" id="productImageError"></small>
                <img class="prev-img" id="prev-img" src="<?= $productImage ?>">
            </div>
            <div class="form-outline form-dark mb-4 text-center">
                <input type="submit" name="submit" class="btn btn-outline-success px-5 py-2" />
            </div>
        </form>
    </div>
</body>

</html>

<script>
    $(document).ready(function () {
        $('#productImage').on('change', function () {
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