<?php
require_once '../config/dbcon.php';

$xml = '<?xml version="1.0" encoding="UTF-8"?>';

// Define the root element
$xml .= "<Product>";

// File name
$file = "data/product.xml";
$fop = fopen($file, 'w') or die("file tidak dapat dibuka");



if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $query = $conn->query("SELECT p.id,
                           p.product_name,
                           p.release_year,
                           p.price,
                           p.product_image,
                           b.description brand_name
                           FROM products p
                           LEFT JOIN brands b ON b.id = p.brand_id");

    while ($record = $query->fetch_assoc()) {
        $xml .= "<Item>";
        foreach ($record as $key => $val) {
            $xml .= "<" . $key . ">";

            // Handle null value;
            if (empty($val)) {
                $xml .= "null";
            } else {
                $xml .= $val;
            }
            $xml .= "</" . $key . ">";
        }
        $xml .= "</Item>";
    }
    $xml .= "</Product>";
    fwrite($fop, $xml);
    fclose($fop);
    echo $file;
}
