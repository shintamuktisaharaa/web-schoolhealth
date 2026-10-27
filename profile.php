<?php
include 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Anda - My School Health</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <div class="logo-website">
        <img src="img/logo.png" alt="Logo">
        <span>My School Health</span>
    </div>
        <ul>
        <li><a href="index.php">Beranda</a></li>
            <li class="dropdown">
                <a href="#">Kunjungan</a>
                <ul>
                    <li><a href="tambahkunjungan.php">Tambah</a></li>
                    <li><a href="daftarkunjungan.php">Lihat</a></li>
                    <li><a href="editkunjungan.php">Edit</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Stok Obat</a>
                <ul>
                    <li><a href="tambahstokobat.php">Tambah</a></li>
                    <li><a href="lihatstokobat.php">Lihat</a></li>
                    <li><a href="editstokobat.php">Edit</a></li>
                </ul>
            </li>
            <li><a href="profile.php" class="profile"><img src="img/user.png" alt="user"></a></li>
    </ul>
</nav>

<div class="profile-box">
    <img src="img/user.png" alt="Profile Logo">
    <?php
    echo "<h1>Profil Pengguna</h1>";
    echo "Username: " . $_SESSION['username'] . "<br>";
    echo "Email: " . $_SESSION['email'] . "<br>";
    ?>
    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
    <!-- Tombol hanya untuk email tertentu -->
    <?php
    if ($_SESSION['email'] === 'smkn1cilegon.pmr@gmail.com') {
        echo '<a href="health_info.php" class="special-access-button">Akses Informasi Kesehatan</a>';
    }
    ?>
</div>

<style>
/* profile.css */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif, sans-serif; 
    background-color: #f7f6fc; /* Latar belakang abu-ungu sangat soft */
}

.profile-box {
    background-color: #c995e6; /* Kotak profil putih bersih */
    color: #4b4453; /* Warna teks utama abu-ungu gelap */
    width: 320px;
    padding: 25px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(140, 122, 230, 0.08); /* Bayangan ungu soft */
}

.profile-box img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 15px;
    object-fit: cover;
    border: 2px solid #615598; /* Garis tepi tipis ungu soft */
}

.profile-box h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #8c7ae6; /* Judul menggunakan ungu soft utama */
}

h1 {
    text-align: center;
    color: #4b4453;
}

.profile-box button {
    background-color: #a8e6cf; /* Hijau soft untuk tombol utama */
    color: #2d3436; /* Teks gelap yang kontras dan nyaman */
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    width: 100%;
}

.profile-box button:hover {
    background-color: #88d4bc; /* Hijau soft lebih gelap saat hover */
}

.special-access-button {
    display: block;
    margin-top: 15px;
    background-color: #bfaaff; /* Ungu soft untuk tombol akses khusus */
    color: #ffffff; /* Teks putih */
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.special-access-button:hover {
    background-color: #a38fe6; /* Ungu soft lebih gelap saat hover */
}
</style>
</body>
</html>
