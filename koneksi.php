<?php
$host = "localhost"; // Sesuaikan dengan nama host MySQL Anda
$user = "root"; // Sesuaikan dengan username MySQL Anda
$pass = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "myschoolhealth"; // Sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
