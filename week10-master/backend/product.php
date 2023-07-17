<?php
require_once '../config/dbcon.php';
include './functions/cleaner.php';

$response = array();
$req = '';
$id_product = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['req'])) {
        $req = $_GET['req'];
    }
    if (isset($_GET['id_product'])) {
        $id_product = $_GET['id_product'];
    }
    if ($req == '' && $id_product == '') {
        $queryAllProduct = $conn->query("SELECT p.id,
                                    p.product_name,
                                    p.release_year,
                                    p.price,
                                    p.product_image,
                                    b.description brand_name,
                                    b.id brand_id
                                    FROM products p
                                    LEFT JOIN brands b ON b.id = p.brand_id");
        while ($data = $queryAllProduct->fetch_assoc()) {
            $response[] = $data;
        }
    }
    if ($id_product != '') {
        $queryOneProduct = $conn->prepare("SELECT p.id,
                                    p.product_name,
                                    p.release_year,
                                    p.price,
                                    p.product_image,
                                    b.description brand_name,
                                    b.id brand_id
                                    FROM products p
                                    LEFT JOIN brands b ON b.id = p.brand_id WHERE p.id = ?");
        $queryOneProduct->bind_param("i", $id_product);
        $queryOneProduct->execute();
        $result = $queryOneProduct->get_result();

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $response[] = $data;
            }
        }
    }

    if ($req == 'brands') {

        $queryAllBrand = $conn->query(" SELECT id,
                                        description
                                        FROM brands
        ");

        while ($data =  $queryAllBrand->fetch_assoc()) {
            $response[] = $data;
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array('error' => false);

    // Determine the action
    $action = $_POST['action'];

    if ($action == 'insert') {
        $productName = cleaner($_POST['productName']);
        $price = cleaner($_POST['price']);
        $brand = cleaner($_POST['brand']);
        $releaseYear = cleaner($_POST['releaseYear']);


        if (empty($productName)) {
            $error['error'] = true;
            $error['productName'] = "Isi field product name";
        }
        if (empty($price)) {
            $error['error'] = true;
            $error['price'] = "Isi field price";
        }
        if (empty($releaseYear)) {
            $error['error'] = true;
            $error['releaseYear'] = "Isi field release year";
        }

        if ($error['error']) {
            echo json_encode($error);
            exit();
        }

        // Valid

        $queryInsert = $conn->prepare("INSERT INTO products (product_name, brand_id, release_year, price)
                                        VALUES (?, ?, ?, ?)");

        $queryInsert->bind_param("siii", $productName, $brand, $releaseYear, $price);

        if ($queryInsert->execute()) {
            $response['status'] = "OK";
            $response['title'] = "Product added";
            $response['msg'] = "Product has been added";
        } else {
            $err = $queryInsert->error;
            $response['status'] = "error";
            $response['title'] = "Product not Added";
            $response['msg'] = "Failed to add product: " . $err;
        }
    } else if ($action == 'update') {
        $productName = cleaner($_POST['productName']);
        $price = cleaner($_POST['price']);
        $brand = cleaner($_POST['brand']);
        $releaseYear = cleaner($_POST['releaseYear']);
        $id_product = cleaner($_POST['id_product']);

        if (empty($productName)) {
            $error['error'] = true;
            $error['productName'] = "Isi field product name";
        }
        if (empty($price)) {
            $error['error'] = true;
            $error['price'] = "Isi field price";
        }
        if (empty($releaseYear)) {
            $error['error'] = true;
            $error['releaseYear'] = "Isi field release year";
        }

        if ($error['error']) {
            echo json_encode($error);
            exit();
        }
        $queryUpdate = $conn->prepare("UPDATE products
                                        SET product_name = ?, brand_id = ?, release_year = ?, price = ?
                                        WHERE id = ?");


        $queryUpdate->bind_param("siiii", $productName, $brand, $releaseYear, $price, $id_product);

        if ($queryUpdate->execute()) {
            $response['status'] = "OK";
            $response['title'] = "Product updated";
            $response['msg'] = "Product has been updated";
        } else {
            $err = $queryUpdate->error;
            $response['status'] = "error";
            $response['title'] = "Product not updated";
            $response['msg'] = "Failed to update product: " . $err;
        }
    } else if ($action == 'delete') {
        $id_product = cleaner($_POST['id_product']);
        $queryDelete = $conn->prepare("DELETE FROM products WHERE id = ?");
        $queryDelete->bind_param("i", $id_product);

        if ($queryDelete->execute()) {
            $response['status'] = "OK";
            $response['title'] = "Product deleted";
            $response['msg'] = "Product has been deleted";
        } else {
            $err = $queryDelete->error;
            $response['status'] = "error";
            $response['title'] = "Product not deleted";
            $response['msg'] = "Failed to delete product: " . $err;
        }
    }
}
echo json_encode($response);
