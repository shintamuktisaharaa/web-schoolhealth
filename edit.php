<?php
include 'koneksi.php';

// Ambil ID kunjungan dari URL
$id_kunjungan = isset($_GET['id_kunjungan']) ? (int)$_GET['id_kunjungan'] : 0;

// Query untuk mengambil data kunjungan
$query = "SELECT * FROM kunjungan WHERE id_kunjungan = $id_kunjungan";
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
    <title>Edit Data Kunjungan</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
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
    <h1>Edit Data Kunjungan</h1>
    <div class="form-container">
        <form method="POST" action="update_kunjungan.php"> 
            <input type="hidden" name="id_kunjungan" value="<?php echo htmlspecialchars($data['id_kunjungan']); ?>">

            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" id="nama" name="nama_siswa" value="<?php echo htmlspecialchars($data['nama_siswa']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal']); ?>" required>
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan</label>
                <input type="text" id="keluhan" name="keluhan" value="<?php echo htmlspecialchars($data['keluhan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_obat">Nama Obat</label>
                <select id="id_obat" name="id_obat">
                    <option value="" <?php echo is_null($data['id_obat']) ? 'selected' : ''; ?>>Pilih Obat</option>
                    <?php
                    // Menampilkan daftar obat
                    $query = "SELECT id_obat, nama_obat FROM stok_obat";
                    $result = mysqli_query($koneksi, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($data['id_obat'] == $row['id_obat']) ? 'selected' : '';
                        echo "<option value='" . $row['id_obat'] . "' $selected>" . $row['nama_obat'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <center>
                <button type="submit" name="update" onClick="return confirm('Simpan data?');">Update</button>
                <span><a href="editkunjungan.php" class="button-batal">Batal</a></span>
            </center>
        </form>
    </div>
</body>
<style>
    button[type="submit"] {
        background-color: yellow; /* Warna latar belakang kuning */
        color: black; /* Warna teks hitam */
        border: none; /* Tanpa batas */
        padding: 10px 15px; /* Jarak dalam tombol */
        text-align: center; /* Teks berada di tengah */
        text-decoration: none; /* Tanpa garis bawah */
        cursor: pointer; /* Menunjukkan bahwa ini adalah elemen klik */
        border-radius: 4px; /* Sudut melengkung pada tombol */
        font-size: 16px; /* Ukuran font */
        width: 19%; /* Lebar tombol hampir 20% untuk dua tombol bersebelahan */
        transition: background-color 0.3s ease; /* Efek transisi saat hover */
    }

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
</style>

</html>
