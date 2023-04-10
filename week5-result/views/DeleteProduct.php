<?php
require_once './config/dbcon.php';
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $queryDeleteProduct = $conn->prepare("DELETE FROM products WHERE id = ?");
    $queryDeleteProduct->bind_param("i", $productId);
    if ($queryDeleteProduct->execute()) {
        header('Location: ./index.php?page=dashboard');
    }
}
