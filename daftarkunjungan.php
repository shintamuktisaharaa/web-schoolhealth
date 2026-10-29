<?php
include "fungsi.php";
include 'session_check.php';

$result = getDataKunjungan(); // Ambil data kunjungan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_obat = $_POST['id_obat'] ?? null;
    $nama_siswa = $_POST['nama_siswa'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $keluhan = $_POST['keluhan'] ?? '';

    if (empty($id_obat)) {
        $id_obat = NULL;
    }

    // Query untuk memasukkan data ke tabel kunjungan
    $query = "INSERT INTO kunjungan (id_obat, nama_siswa, kelas, tanggal, keluhan) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("issss", $id_obat, $nama_siswa, $kelas, $tanggal, $keluhan);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Data berhasil ditambahkan ke daftar kunjungan.";
    } else {
        echo "Gagal menambahkan data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School Health - Daftar Kunjungan</title>
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
    <center><h1>Daftar Kunjungan</h1>
    <form method="post">
        <input type="text" name="keyword" placeholder="Cari data...">
        <button type="submit" name="cari">Cari</button>
</center>
    </form>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Nama Obat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mengambil data kunjungan
            $result = getDataKunjungan();

            if (mysqli_num_rows($result) > 0) {
                $no = 1; // Inisialisasi nomor
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>"; // Nomor otomatis
                    echo "<td>" . $row['nama_siswa'] . "</td>";
                    echo "<td>" . $row['kelas'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['keluhan'] . "</td>";
                    echo "<td>" . (!empty($row['nama_obat']) ? $row['nama_obat'] : "Tidak Perlu Obat") . "</td>";
                    echo "</tr>";
                    $no++; // Increment nomor
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data kunjungan yang tersedia</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <form action="export_kunjungan_pdf.php" method="post" class="download-form" style="text-align: right; margin-bottom: 20px;">
    <label for="bulan">Bulan:</label>
    <select name="bulan" id="bulan">
        <option value="all">Semua</option>
        <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <label for="tahun">Tahun:</label>
    <input type="number" name="tahun" id="tahun" value="<?= date('Y') ?>" required>
    <button type="submit">Unduh PDF</button>
</form>

<style>
.download-form {
    text-align: right;
    margin-bottom: 20px;
    color: #4b4453;
}

.download-form label {
    margin-right: 10px; /* Spasi antara label dan input */
    color: #4b4453;
    font-weight: 500;
}

.download-form select, 
.download-form input[type="number"] {
    width: 80px; /* Lebar input bulan dan tahun */
    padding: 8px; /* Spasi di dalam input */
    margin-right: 10px; /* Spasi di antara input */
    background-color: #fbf9ff; /* Ungu sangat soft */
    border: 1px solid #dcd6f7; /* Garis tepi ungu soft */
    border-radius: 5px;
    color: #4b4453;
    font-size: 14px;
    box-sizing: border-box;
}

.download-form select:focus, 
.download-form input[type="number"]:focus {
    border-color: #a8e6cf; /* Hijau soft saat fokus */
    outline: none;
    box-sizing: border-box;
    box-shadow: 0 0 5px rgba(168, 230, 207, 0.5);
}

.download-form button {
    display: block; /* Agar tombol bisa diletakkan di tengah */
    margin: 15px auto 0; /* Memusatkan tombol */
    padding: 10px 15px; /* Spasi di dalam tombol */
    background-color: #a8e6cf; /* Hijau soft sebagai pengganti tombol merah */
    color: #2d3436; /* Teks gelap yang kontras dan nyaman dibaca */
    border: none; /* Tanpa border */
    border-radius: 6px; /* Sudut tombol melengkung */
    cursor: pointer; /* Menunjukkan bahwa tombol bisa diklik */
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.download-form button:hover {
    background-color: #88d4bc; /* Hijau soft lebih gelap saat dihover */
}
</style>
</body>
</html>
