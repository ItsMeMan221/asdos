<?php
$serverName = "localhost";
$username = "root";
$password = "";
// Change the name of database to yours
$database = "";

// Membuat Koneksi
$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error) {
    die("Konkesi Error: " . $conn->connect_error);
}
