<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ph_data";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn){
    echo "Koneksi Gagal";
}

?>