<?php
$serverName = "localhost";
$username = "root";
$password = "";
$database = "week15";

// Membuat Koneksi 
$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error) {
    die("Konkesi Error: " . $conn->connect_error);
}
