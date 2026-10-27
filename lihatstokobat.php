<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>My School Health - Lihat Stok Obat</title>
</head>
<body>
	<!-- Navbar same as previous page -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My School Health</title>
        <link rel="stylesheet" href="style.css">
    </head>
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

	<center><h1>Daftar Stok Obat</h1></center>
  <form method="post">
      <center>
        <input type="text" name="keyword" placeholder="Cari data...">
      <button type="submit" name="cari">Cari</button>
      <center>
    </form>
	
	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>
				<th>Stok Obat</th>
				<th>Deskripsi Obat</th>
				<th>Tanggal Kadaluwarsa</th>
			</tr>
		</thead>
		<tbody>
    <?php
    // Sertakan file fungsi
    include "fungsi.php";
    
    // Ambil data stok obat
    $stok_obat = ambilStokObat();
    $no = 1; // Untuk nomor urut

    // Tampilkan data dalam tabel
    foreach ($stok_obat as $obat) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($obat['nama_obat']) . "</td>"; // Nama obat
        echo "<td>" . htmlspecialchars($obat['stok_obat']) . "</td>"; // Stok obat
        echo "<td>" . htmlspecialchars($obat['deskripsi_obat']) . "</td>"; // Deskripsi obat
        echo "<td>" . htmlspecialchars($obat['tanggal_kadaluwarsa']) . "</td>"; // Tanggal kadaluwarsa
        echo "</tr>";
    }
    ?>
		</tbody>
	</table>
	
	<!-- You can add JavaScript code here to populate the table with data -->
	
</body>
</html>