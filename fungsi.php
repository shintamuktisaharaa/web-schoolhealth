<?php
// Sertakan koneksi database
include "koneksi.php";

// Fungsi untuk menambah kunjungan
function tambahkunjungan($data) {
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $data['kelas']);
    $tanggal = mysqli_real_escape_string($koneksi, $data['tanggal']);
    $keluhan = mysqli_real_escape_string($koneksi, $data['keluhan']);

    // Cek apakah id_obat dipilih dan atur ke NULL jika tidak ada
    $id_obat = !empty($data['id_obat']) ? mysqli_real_escape_string($koneksi, $data['id_obat']) : NULL;

    // Menyimpan kunjungan ke dalam tabel
    // Jika $id_obat adalah NULL, gunakan kata kunci NULL tanpa tanda kutip
    $query = "INSERT INTO kunjungan (nama_siswa, kelas, tanggal, keluhan, id_obat) 
              VALUES ('$nama', '$kelas', '$tanggal', '$keluhan', " . ($id_obat === NULL ? "NULL" : "'$id_obat'") . ")";

    if (mysqli_query($koneksi, $query)) {
        // Jika id_obat ada, kurangi stok obat   
        if ($id_obat !== NULL) {
            $update_query = "UPDATE stok_obat SET stok_obat = stok_obat - 1 WHERE id_obat = '$id_obat'";
            if (!mysqli_query($koneksi, $update_query)) {
                echo "Error updating stock: " . mysqli_error($koneksi);
            }
        }
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = 'daftarkunjungan.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

function getDataKunjungan() {
    global $koneksi;

    // Query untuk mengambil data kunjungan dan menghubungkannya dengan tabel stok_obat
    $query = "SELECT kunjungan.nama_siswa, kunjungan.kelas, kunjungan.tanggal, kunjungan.keluhan, stok_obat.nama_obat 
              FROM kunjungan
              LEFT JOIN stok_obat ON kunjungan.id_obat = stok_obat.id_obat
              ORDER BY kunjungan.tanggal DESC"; // Mengurutkan berdasarkan tanggal
    
    // Eksekusi query
    $result = mysqli_query($koneksi, $query);
    
    // Return hasil query
    return $result;
}


function updatekunjungan($data, $id_kunjungan) {
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $data['kelas']);
    $tanggal = mysqli_real_escape_string($koneksi, $data['tanggal']);
    $keluhan = mysqli_real_escape_string($koneksi, $data['keluhan']);
    
    // Cek apakah id_obat dipilih dan atur ke NULL jika tidak ada
    $id_obat = !empty($data['id_obat']) ? mysqli_real_escape_string($koneksi, $data['id_obat']) : NULL;

    // Ambil data kunjungan sebelumnya
    $query = "SELECT id_obat FROM kunjungan WHERE id_kunjungan = '$id_kunjungan'";
    $result = mysqli_query($koneksi, $query);
    $prev_data = mysqli_fetch_assoc($result);
    $prev_id_obat = $prev_data['id_obat'];

    // Update data kunjungan
    $update_query = "UPDATE kunjungan SET 
                        nama_siswa = '$nama', 
                        kelas = '$kelas', 
                        tanggal = '$tanggal', 
                        keluhan = '$keluhan', 
                        id_obat = " . ($id_obat === NULL ? "NULL" : "'$id_obat'") . " 
                    WHERE id_kunjungan = '$id_kunjungan'";

    if (mysqli_query($koneksi, $update_query)) {
        // Hanya update stok jika id_obat diubah
        if ($prev_id_obat !== $id_obat) {
            // Kembalikan stok obat sebelumnya jika ada
            if ($prev_id_obat !== NULL) {
                $restore_query = "UPDATE stok_obat SET stok_obat = stok_obat + 1 WHERE id_obat = '$prev_id_obat'";
                mysqli_query($koneksi, $restore_query);
            }

            // Kurangi stok obat baru jika dipilih
            if ($id_obat !== NULL) {
                $reduce_query = "UPDATE stok_obat SET stok_obat = stok_obat - 1 WHERE id_obat = '$id_obat'";
                mysqli_query($koneksi, $reduce_query);
            }
        }
        echo "<script>alert('Data berhasil diupdate!'); window.location.href = 'daftarkunjungan.php';</script>";
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($koneksi);
    }
}

// Fungsi untuk menghapus kunjungan
function deleteKunjungan($id_kunjungan) {
    global $koneksi;

    $query = "DELETE FROM kunjungan WHERE id_kunjungan = $id_kunjungan";
    mysqli_query($koneksi, $query);
}

function carikunjungan($keyword) {
    global $koneksi;
    $keyword = strtolower($keyword); // Ubah ke huruf kecil

    $query = "SELECT k.id_kunjungan, k.nama_siswa, k.kelas, k.tanggal, k.keluhan, 
                     COALESCE(o.nama_obat, 'Tidak Perlu Obat') AS nama_obat
              FROM kunjungan k 
              LEFT JOIN stok_obat o ON k.id_obat = o.id_obat 
              WHERE LOWER(k.nama_siswa) LIKE LOWER(?) 
              OR LOWER(k.kelas) LIKE LOWER(?) 
              OR LOWER(k.tanggal) LIKE LOWER(?) 
              OR LOWER(k.keluhan) LIKE LOWER(?) 
              OR LOWER(COALESCE(o.nama_obat, 'Tidak Perlu Obat')) LIKE LOWER(?)";

    $stmt = $koneksi->prepare($query);
    $likeKeyword = "%$keyword%";
    $stmt->bind_param("sssss", $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword, $likeKeyword);
    $stmt->execute();
    
    $result = $stmt->get_result();
    return $result;
}

// Fungsi untuk menambah stok obat
function tambahstokobat($data) {
    global $koneksi;

    $nama_obat = mysqli_real_escape_string($koneksi, $data['nama_obat']);
    $stok_obat = mysqli_real_escape_string($koneksi, $data['stok_obat']);
    $deskripsi_obat = mysqli_real_escape_string($koneksi, $data['deskripsi_obat']);
    $tanggal_kadaluwarsa = mysqli_real_escape_string($koneksi, $data['tanggal_kadaluwarsa']);

    $query = "INSERT INTO stok_obat (nama_obat, stok_obat, deskripsi_obat, tanggal_kadaluwarsa) 
              VALUES ('$nama_obat', '$stok_obat', '$deskripsi_obat', '$tanggal_kadaluwarsa')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href = 'lihatstokobat.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Fungsi untuk mengambil semua data stok obat
function ambilStokObat() {
    global $koneksi;

    // Query untuk mengambil data dari tabel stok_obat
    $query = "SELECT * FROM stok_obat";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $stok_obat = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $stok_obat[] = $row;
    }

    return $stok_obat;
}

// Fungsi untuk mendapatkan data obat berdasarkan ID
function ambilObatById($id_obat) {
    global $koneksi;

    // Query untuk mengambil data obat berdasarkan ID
    $query = "SELECT * FROM stok_obat WHERE id_obat = '$id_obat'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    return mysqli_fetch_assoc($result);
}

// Fungsi untuk memperbarui data obat
function updateObat($data) {
    global $koneksi;

    $id_obat = htmlspecialchars($data['id_obat']);
    $nama_obat = htmlspecialchars($data['nama_obat']);
    $stok_obat = htmlspecialchars($data['stok_obat']);
    $deskripsi_obat = htmlspecialchars($data['deskripsi_obat']);
    $tanggal_kadaluwarsa = htmlspecialchars($data['tanggal_kadaluwarsa']);

    // Query untuk memperbarui data
    $query = "UPDATE stok_obat SET
                nama_obat = '$nama_obat',
                stok_obat = '$stok_obat',
                deskripsi_obat = '$deskripsi_obat',
                tanggal_kadaluwarsa = '$tanggal_kadaluwarsa'
              WHERE id_obat = '$id_obat'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi untuk menghapus data obat
function hapusObat($id_obat) {
    global $koneksi;

    $query = "DELETE FROM stok_obat WHERE id_obat = $id_obat";
    return mysqli_query($koneksi, $query);
}
?>
