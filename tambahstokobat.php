<?php
// Menghubungkan ke file koneksi.php
include "koneksi.php";
include 'session_check.php';

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School Health - Tambah Stok Obat </title>
    <link rel="stylesheet" href="style.css">
</head>

<!-- Navbar -->
<nav>
  <!-- Logo and website name on the right side -->
  <div class="logo-website">
    <img src="img/logo.png" alt="Logo">
    <span>My School Health</span>
  </div>
  <!-- Menu items on the left side -->
  <ul>
    <li>
      <a href="index.php">Beranda</a>
    </li>
    <li class="dropdown">
      <a href="#">Kunjungan</a>
      <ul>
        <li><a href="tambahkunjungan.php">Tambah </a></li>
        <li><a href="daftarkunjungan.php">Lihat</a></li>
        <li><a href="editkunjungan.php">Edit</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#">Stok Obat</a>
      <ul>
        <li><a href="tambahstokobat.php">Tambah </a></li>
        <li><a href="lihatstokobat.php">Lihat</a></li>
        <li><a href="editstokobat.php">Edit </a></li>
      </ul>
    </li>
    <li>
      <a href="profile.php" class="profile">
          <img src="img/user.png" alt="user">
        <i class="fas fa-user"></i>
      </a>
    </li>
  </ul>
</nav>
<br></br>
<br></br>
<br></br>

<!-- Input stok obat Page -->
 <body>
 <h1>Tambah Stok Obat</h1>
 <div class="tambah-stok-obat">
 <div class="form-container">
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_obat">Nama Obat</label>
                <input type="text" id="nama_obat" name="nama_obat">
            </div>
            <div class="form-group">
                <label for="stok_obat">Stok Obat</label>
                <input type="number" id="stok_obat" name="stok_obat" min="0">
            </div>
            <div class="form-group">
                <label for="deskripsi_obat">Deskripsi Obat</label>
                <input type="text" id="deskripsi_obat" name="deskripsi_obat">
            </div>
            <div class="form-group">
                <label for="tanggal_kadaluwarsa">Tanggal Kadaluwarsa</label>
                <input type="date" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa">
            </div>
        <center>
            <input type="submit" name="proses" value="Simpan" onClick="return confirm('Simpan data?');">
            <input type="reset" value="Batal" onClick="return confirm('Batal Simpan Data?');">
                  </center>
        </div>
    </div>
</div>
    </form>
</div>
<?php
    include "fungsi.php";
    if (isset($_POST['proses'])) {
        tambahstokobat($_POST);
    }
    ?>

</body>
</html>