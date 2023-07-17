<?php
require_once '../config/dbcon.php';

$response = [];
if ($_SERVER["REQUEST_METHOD"] == 'GET') {

    $queryAll = $conn->query("SELECT * FROM artikel");

    while ($data = $queryAll->fetch_assoc()) {
        $response[] = $data;
    }
}
echo json_encode($response);
