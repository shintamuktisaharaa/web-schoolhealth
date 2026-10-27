<?php
include 'koneksi.php';
include 'session_check.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School Health - Edit Daftar Kunjungan</title>
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
    <h1>Edit/Hapus Daftar Kunjungan</h1>
    <form method="post">
        <input type="text" name="keyword" placeholder="Cari data...">
        <button type="submit" name="cari">Cari</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Obat</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Inisialisasi variabel
            $keyword = "";
            $query = "SELECT k.id_kunjungan, k.nama_siswa, k.kelas, k.tanggal, k.keluhan, 
                             COALESCE(o.nama_obat, 'Tidak Perlu Obat') AS nama_obat 
                      FROM kunjungan k 
                      LEFT JOIN stok_obat o ON k.id_obat = o.id_obat";

            // Cek apakah tombol cari ditekan
            if (isset($_POST['cari'])) {
                $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']); // Sanitasi input
                $query .= " WHERE k.nama_siswa LIKE '%$keyword%' OR k.kelas LIKE '%$keyword%'"; // Menambahkan kondisi pencarian
            }

            // Eksekusi query
            $result = mysqli_query($koneksi, $query);
            $no = 1;

            // Cek hasil query
            if (mysqli_num_rows($result) > 0) {
                // Tampilkan data
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama_siswa']}</td>
                            <td>{$row['kelas']}</td>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['keluhan']}</td>
                            <td>{$row['nama_obat']}</td>
                            <td>
                                <span><a href='edit.php?id_kunjungan={$row['id_kunjungan']}'>Edit</a> | </span>
                                <span><a href='hapus.php?id={$row['id_kunjungan']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a></span>
                            </td>
                        </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='7'>Data tidak ditemukan</td></tr>"; // Pesan jika tidak ada data
            }
        ?>
        </tbody>
    </table>

    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "hapus.php?id=" + id; // Redirect ke script hapus
            }
        }
    </script>
</body>
</html>
