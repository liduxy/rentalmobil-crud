<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "rental_mobil";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}
?>
