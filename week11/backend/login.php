<?php
session_start();
require_once '../config/dbcon.php';

$error = [
    "error_status" => "false"
];

$response = [];
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $userId = $_POST["userId"];
    $password = $_POST["password"];

    if (empty($userId)) {
        $error["error_status"] = "true";
        $error["userId"] = "Mohon isi userid";
    }
    if (empty($password)) {
        $error["error_status"] = "true";
        $error["password"] = "Mohon isi field password";
    }

    if ($error["error_status"] == 'true') {
        echo json_encode($error);
        exit();
    }

    $queryLogin = $conn->prepare("SELECT * FROM user WHERE user_id = ? AND password = ?");
    $queryLogin->bind_param("ss", $userId, $password);

    $queryLogin->execute();
    $res = $queryLogin->get_result();
    $num_row = $res->num_rows;

    if ($num_row > 0) {
        $_SESSION['AUTH'] = "true";

        $response["status"] = "OK";
        $response["msg"] = "Login success";
    } else {
        $_SESSION["AUTH"] = "false";
        $response["status"] = "error";
        $response["msg"] = "Credential tidak pernah terdaftar";
    }
}
echo json_encode($response);
