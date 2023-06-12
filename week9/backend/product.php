<?php
require_once '../config/dbcon.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // TODO 1 : getting all data
    $queryAllProduct = $conn->query("SELECT p.id,
                                    p.product_name,
                                    p.release_year,
                                    p.price,
                                    p.product_image,
                                    b.description brand_name
                                    FROM products p
                                    LEFT JOIN brands b ON b.id = p.brand_id");
    while ($data = $queryAllProduct->fetch_assoc()) {
        $response[] = $data;
    }
}
echo json_encode($response);
