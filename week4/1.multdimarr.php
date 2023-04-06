<?php

$books = array(
    array("Judul" => "Harry Potter", "Pengarang" => "J.K Rowling", "Genre" => array()),
    array("Judul" => "Women & Power", "Pengarang" => "Mary Beard"),
    array("Judul" => "The Elegant Universe", "Pengarang" => "Brian Greene"),
);


// Pendekatan manual 
// echo "Judul Buku: " . $books[0]["Judul"] . " <br> Pengarang:  " . $books[0]["Pengarang"] . "<br>";
// echo "Judul Buku: " . $books[1]["Judul"] . " <br> Pengarang:  " . $books[1]["Pengarang"];

//  Pendekatan menggunakan looping
foreach ($books as $book) {
    foreach ($book as $isi => $isi_val) {
        echo $isi . " : " . $isi_val;
        echo "<br>";
    }
}
?>