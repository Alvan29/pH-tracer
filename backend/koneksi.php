<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ph_data";

$conn = mysqli_connect($host, $user, $pass, $dbname);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (!$conn){
    echo "Koneksi Gagal";
}

?>