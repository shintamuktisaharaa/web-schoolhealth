<?php
include 'koneksi.php';

// Fungsi untuk menampilkan data
function display_data($koneksi) {
    $query = "SELECT * FROM health_info";
    $result = mysqli_query($koneksi, $query);

    echo '<h2>Informasi Kesehatan</h2>';
    echo '<div class="health-info">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="blob">';
        echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
        echo '<p>' . htmlspecialchars($row['content']) . '</p>';
        echo '<a href="?action=edit&id=' . $row['id'] . '">Edit</a> | ';
        echo '<a href="?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Hapus</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '<a href="?action=add">Tambah Informasi Baru</a>';
    echo '<div style="text-align: center; margin-top: 15px;">
            <a href="index.php" style="color: #d32f2f; text-decoration: bold;">Kembali</a>
        </div>';


}

// Fungsi untuk menambah data
function add_form() {
    echo '<h2>Tambah Informasi Baru</h2>';
    echo '<form method="post" action="?action=save">';
    echo '<label for="title">Judul:</label><br>';
    echo '<input type="text" name="title" required><br>';
    echo '<label for="content">Isi:</label><br>';
    echo '<textarea name="content" required></textarea><br>';
    echo '<button type="submit">Simpan</button>';
    echo '<div style="text-align: center; margin-top: 15px;">
            <a href="health_info.php" style="color: #d32f2f; text-decoration: bold;">Kembali</a>
        </div>';

    echo '</form>';
}

// Fungsi untuk mengedit data
function edit_form($koneksi, $id) {
    $query = "SELECT * FROM health_info WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    echo '<h2>Edit Informasi</h2>';
    echo '<form method="post" action="?action=update">';
    echo '<input type="hidden" name="id" value="' . $data['id'] . '">';
    echo '<label for="title">Judul:</label><br>';
    echo '<input type="text" name="title" value="' . htmlspecialchars($data['title']) . '" required><br>';
    echo '<label for="content">Isi:</label><br>';
    echo '<textarea name="content" required>' . htmlspecialchars($data['content']) . '</textarea><br>';
    echo '<button type="submit">Update</button>';
    echo '<div style="text-align: center; margin-top: 15px;">
            <a href="health_info.php" style="color: #d32f2f; text-decoration: bold;">Kembali</a>
        </div>';
    echo '</form>';
}

// Proses tambah atau update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['action'] == 'save') {
        $title = mysqli_real_escape_string($koneksi, $_POST['title']);
        $content = mysqli_real_escape_string($koneksi, $_POST['content']);

        // Hapus data lama sebelum menambahkan data baru
        $query_delete_oldest = "DELETE FROM health_info WHERE id = (SELECT MIN(id) FROM health_info)";
        mysqli_query($koneksi, $query_delete_oldest);

        // Tambahkan data baru
        $query_insert = "INSERT INTO health_info (title, content) VALUES ('$title', '$content')";
        mysqli_query($koneksi, $query_insert);

        header('Location: health_info.php');
    }

    if ($_GET['action'] == 'update') {
        $id = $_POST['id'];
        $title = mysqli_real_escape_string($koneksi, $_POST['title']);
        $content = mysqli_real_escape_string($koneksi, $_POST['content']);

        $query = "UPDATE health_info SET title='$title', content='$content' WHERE id=$id";
        mysqli_query($koneksi, $query);

        header('Location: health_info.php');
    }
}

// Proses hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM health_info WHERE id = $id";
    mysqli_query($koneksi, $query);

    header('Location: health_info.php');
}

// Logika Tampilan
if (!isset($_GET['action'])) {
    display_data($koneksi);
} elseif ($_GET['action'] == 'add') {
    add_form();
} elseif ($_GET['action'] == 'edit' && isset($_GET['id'])) {
    edit_form($koneksi, $_GET['id']);
}
?>


     <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informasi Kesehatan - My School Health</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <style>
    /* General Styling */
    body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    }

    h2 {
    text-align: center;
    color:#d32f2f;
    margin-bottom: 20px;
    }

    /* Container */
    .health-info {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
    }

    /* Individual Blob Styling */
    .blob {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    transition: transform 0.2s ease-in-out;
    }

    .blob:hover {
    transform: translateY(-5px);
    }

    .blob h4 {
    margin-top: 0;
    font-size: 20px;
    color: #333;
    }

    .blob p {
    font-size: 14px;
    margin: 10px 0;
    color: #555;
    }

    .blob a {
    text-decoration: none;
    font-size: 14px;
    color: #d32f2f;
    margin-right: 10px;
    }

    .blob a:hover {
    text-decoration: underline;
    }

    /* Form Styling */
    form {
    width: 400px;
    margin: 50px auto; /* Form di tengah */
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center; /* Pusatkan teks */
    }

    /* Form Label */
    form label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
    text-align: left; /* Tetap rata kiri untuk label */
    }

    /* Form Input Fields */
    form input[type="text"],
    form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    }

    /* Form Submit Button */
    form button {
    background: #ffeb3b;;
    color: #fff;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    }

    form button:hover {
    background: #ffeb3b;;
    }

    /* General Links Styling */
    a {
    color: #ff0303;;
    text-decoration: none;
    }

    a:hover {
    text-decoration: underline;
    }
    /* Responsive Design */
    @media (max-width: 768px) {
    .blob {
        width: 90%;
    }

    form {
        width: 90%;
    }
    }
    </style>