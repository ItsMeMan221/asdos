<?php

/* $SERVER adalah sebuah super global 
    variable yang menyimpan informasi header, path dan lokasi script 
*/

$servers = array();

$servers['lokasi_project'] = $_SERVER['PHP_SELF'];
$servers['nama_server'] = $_SERVER['SERVER_NAME'];
$servers['user_agent_http'] = $_SERVER['HTTP_USER_AGENT'];
$servers['ip_addr']  = $_SERVER['SERVER_ADDR'];
$servers['metode_request'] = $_SERVER['REQUEST_METHOD'];
$servers['port_server'] = $_SERVER['SERVER_PORT'];

foreach ($servers as $server => $server_value) {
    echo $server . ": " . $server_value;
    echo "<br>";
}
