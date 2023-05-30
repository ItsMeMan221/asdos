<?php
require_once '../config/config.php';

$id;
$allData = array();
$str = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        $dataQuery = $conn->query("SELECT p.id, b.description, 
                                p.product_name, 
                                p.release_year, 
                                p.price, 
                                p.product_image 
                                FROM products p 
                                LEFT JOIN brands b ON p.brand_id = b.id");

        while ($data = $dataQuery->fetch_assoc()) {
            // $allData[] = $data;
            $str .= 'id : ' . $data['id'] . ' <br> Product Name : '
                . $data['product_name'] . ' <br>'
                . '<br> Brand Name : '
                . $data['description'] . ' <br>'
                . '<br> Price : '
                . $data['price'] . ' <br>'
                . '<br> Release Year : '
                . $data['release_year'] . '<br>';
        }
    } else {
        $id = $_GET['id'];
        $dataQuery = $conn->prepare("SELECT p.id, b.description, 
        p.product_name, 
        p.release_year, 
        p.price, 
        p.product_image 
        FROM products p 
        LEFT JOIN brands b ON p.brand_id = b.id WHERE p.id = ?");
        $dataQuery->bind_param("i", $id);
        $dataQuery->execute();
        $resQuery = $dataQuery->get_result();
        $rows = $resQuery->fetch_assoc();
        $str = 'id : ' . $rows['id'] . ' <br> Product Name : '
            . $rows['product_name'] . ' <br>'
            . '<br> Brand Name : '
            . $rows['description'] . ' <br>'
            . '<br> Price : '
            . $rows['price'] . ' <br>'
            . '<br> Release Year : '
            . $rows['release_year'] . '<br>';
    }
    // echo json_encode($allData);
    echo $str;
}
?>