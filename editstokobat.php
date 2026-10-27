<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>My School Health - Edit Stok Obat</title>
</head>
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My School Health</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <nav>
        <div class="logo-website">
        <img src="img/logo.png" alt="Logo">
          <span></a>My School Health</span>
        </div>
        <!-- Menu Navbar-->
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
<body>
    <h1>Edit Stok Obat</h1>
    <center><input type="text" name="keyword" placeholder="Cari Obat...">
    <button type="submit" name="cari">Cari</button></center>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Tanggal Kadaluwarsa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                <?php
                include "fungsi.php"; // Sertakan fungsi.php

                // Ambil data stok obat
                $stok_obat = ambilStokObat();
                $no = 1; // Nomor urut

                // Tampilkan data
                foreach ($stok_obat as $row) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama_obat']}</td>
                            <td>{$row['stok_obat']}</td>
                            <td>{$row['deskripsi_obat']}</td>
                            <td>{$row['tanggal_kadaluwarsa']}</td>
                            <td>
                                <span><a href='edit_obat.php?id_obat={$row['id_obat']}'>Edit</a> | </span>
                                <span><a href='hapus_obat.php?id_obat={$row['id_obat']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a></span>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>

    </table>
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus jenis obat ini?")) {
                window.location.href = "hapus.php?id=" + id; // Redirect ke script hapus
            }
        }
    </script>

</body>
</html>
