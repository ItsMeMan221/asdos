<?php
/* GLOBALS adalah sebuah super global variable yang digunakan
    untuk mengakses sebuah variable 
*/

$angka1 = 1;
function addition()
{

    /* Untuk mengakses variable menggunakan GLOBALS, penulisannya mirip seperti
        pengaksesan value dari associative array
    */
    $GLOBALS['angka2'] = $GLOBALS['angka1'] + 1;
}

addition();
$hasil = $GLOBALS['angka1'] + $GLOBALS['angka2'];

echo $hasil;
