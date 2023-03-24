<?php
if (isset($_GET['submit'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    if (empty($email)) {
        echo "Email kosong";
    }
    if (empty($password)) {
        echo "password kosong";
    }
    echo "EMAIL : " . $email . "<br>";
    echo "PASSWORD : " . $password  . "<br>";
}
