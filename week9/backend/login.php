<?php
require_once '../config/dbcon.php';
include './functions/cleaner.php';


session_start();
// Validation purposes
$error = array(
    'error' => false
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = cleaner($_POST['email']);
    $password = cleaner($_POST['password']);

    if (empty($email)) {
        $error['error'] = true;
        $error['email'] = "Isi field email";
    }
    if (empty($password)) {
        $error['error'] = true;
        $error['password'] = "Isi field password";
    }

    if ($error['error']) {
        echo json_encode($error);
        exit();
    }

    // Valid input
    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();

    $res = $query->get_result();
    $row = $res->fetch_assoc();

    $num_row =$res->num_rows;

    if ($num_row > 0) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['AUTH'] = true;
            $_SESSION['USER_DATA'] = $row;

            $response = array(
                'status' => 'OK',
                'message' => 'Login success'
            );
        } else {
            $response = array(
                'status' => "error",
                'message' => "Login failed, credential anda salah!"
            );
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "Email belum pernah terdaftar"
        );
    }
    echo json_encode($response);
    $conn->close();
    exit();
}
?>