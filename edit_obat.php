<?php
include 'koneksi.php';

// Ambil ID obat dari URL
$id_obat = isset($_GET['id_obat']) ? (int)$_GET['id_obat'] : 0;

// Query untuk mengambil data obat
$query = "SELECT * FROM stok_obat WHERE id_obat = $id_obat";
$result = mysqli_query($koneksi, $query);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    echo "Data tidak ditemukan!";
    exit; // Keluar jika data tidak ditemukan
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stok Obat - My School Health</title>
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
      <a href="#" class="profile">
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
<body>
    <h1>Edit Stok Obat</h1>
    <div class="tambah-stok-obat">
        <div class="form-container">
            <form method="POST" action="update_obat.php"> 
                <input type="hidden" name="id_obat" value="<?php echo $data['id_obat']; ?>">

                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" id="nama_obat" name="nama_obat" value="<?php echo htmlspecialchars($data['nama_obat']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="stok_obat">Stok Obat</label>
                    <input type="number" id="stok_obat" name="stok_obat" value="<?php echo htmlspecialchars($data['stok_obat']); ?>" min="0" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi_obat">Deskripsi Obat</label>
                    <input type="text" id="deskripsi_obat" name="deskripsi_obat" value="<?php echo htmlspecialchars($data['deskripsi_obat']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_kadaluwarsa">Tanggal Kadaluwarsa</label>
                    <input type="date" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" value="<?php echo $data['tanggal_kadaluwarsa']; ?>" required>
                </div>

                <center>
                    <input type="submit" name="proses" value="Simpan" onClick="return confirm('Simpan data?');">
                    <span> <a href="editstokobat.php" class="button-batal">Batal</a></span>              
                </center>
            </form>
        </div>
    </div>
</body>
<style>
/* Mengubah warna tombol saat hover */
button[type="submit"]:hover {
    opacity: 0.9; /* Efek transparansi saat hover */
}
.button-batal {
    background-color: #dc3545; /* Warna merah */
    color: rgb(255, 255, 255); /* Warna teks putih */
    padding: 10px 15px; /* Jarak dalam tombol */
    text-align: center; /* Teks berada di tengah */
    text-decoration: none; /* Menghilangkan garis bawah link */
    display: inline-block; /* Menampilkan sebagai elemen blok dalam satu baris */
    margin: 10px 0; /* Margin antara tombol */
    cursor: pointer; /* Mengubah kursor menjadi pointer */
    border-radius: 4px; /* Membuat sudut tombol melengkung */
    font-size: 16px; /* Ukuran teks */
    transition: background-color 0.3s ease; /* Efek transisi saat di hover */
}

.button-batal:hover {
    background-color: #c82333; /* Warna merah yang lebih gelap saat hover */
    opacity: 0.9; /* Transparansi saat hover */
}
    </style>

</body>
</html>
