<?php
$serverName = "localhost";
$username = "root";
$password = "";
$database = "techx_inventory_systems";

// Membuat Koneksi 
$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error) {
    die("Konkesi Error: " . $conn->connect_error);
}