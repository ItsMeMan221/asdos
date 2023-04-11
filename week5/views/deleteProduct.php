<?php
require_once './config/dbcon.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $queryDelete = $conn->prepare("DELETE FROM products WHERE id = ?");
    $queryDelete->bind_param("i", $productId);
    if ($queryDelete->execute()) {
        header("Location: ./index.php?page=dashboard");
    }
}

?>