<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My school Health-Tambah Kunjungan</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
    <script src="script.js" defer></script> <!-- Link ke file JavaScript -->
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
<br></br>
<!-- Input Data Kunjungan Page -->
<?php
// Menghubungkan ke file koneksi.php
include "koneksi.php";
?>
<body>
    <h1>Input Data Kunjungan</h1>
    <div class="form-container">
        <form action="" method="post">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan</label>
                <input type="text" id="keluhan" name="keluhan" required>
            </div>
            <div class="form-group">
                <label for="id_obat">Nama Obat</label>
                <select id="id_obat" name="id_obat">
                    <option value="" disabled selected>Pilih Obat</option>
                    <?php
                    include "koneksi.php";
                    $query = "SELECT id_obat, nama_obat FROM stok_obat";
                    $result = mysqli_query($koneksi, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id_obat'] . "'>" . $row['nama_obat'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <center>
                <input type="submit" name="proses" value="Simpan" onClick="return confirm('Simpan data?');">
                <input type="reset" value="Batal" onClick="return confirm('Batal Simpan Data?');">
            </center>
        </form>
    </div>

    <?php
    include "fungsi.php";
    if (isset($_POST['proses'])) {
        tambahkunjungan($_POST);
    }
    ?>
</body>

