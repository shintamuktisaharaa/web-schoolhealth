<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login dan apakah emailnya adalah admin
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'smkn1cilegon.pmr@gmail.com') {
    header("Location: login.php");
    exit();
}

$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek duplikasi email
    $checkQuery = "SELECT * FROM login WHERE email = ?";
    $stmt = $koneksi->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pesan = "Email sudah terdaftar!";
    } else {
        $insertQuery = "INSERT INTO login (email, username, password) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($insertQuery);
        $stmt->bind_param("sss", $email, $username, $password);
        if ($stmt->execute()) {
            echo "<script>alert('User baru berhasil ditambahkan oleh Admin!'); window.location='profile.php';</script>";
            exit();
        } else {
            $pesan = "Pendaftaran gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru - My School Health</title>
    <style>
        body {
            background-color: #f7f6fc;
            font-family: 'Lucida Sans', sans-serif;
            color: #4b4453;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #ffffff;
            color: #4b4453;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(140, 122, 230, 0.08);
            width: 320px;
            text-align: center;
        }
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #dcd6f7;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #fbf9ff;
            color: #4b4453;
        }
        input:focus {
            border-color: #a8e6cf;
            outline: none;
            box-shadow: 0 0 5px rgba(168, 230, 207, 0.5);
        }
        button {
            background-color: #a8e6cf;
            color: #2d3436;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 6px;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #88d4bc;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            color: #8c7ae6;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #e056fd;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="tambah_user.php" method="POST">
        <h2>Tambah User Baru</h2>
        
        <?php if (!empty($pesan)): ?>
            <div class="error-message"><?php echo $pesan; ?></div>
        <?php endif; ?>

        <label style="float:left;">Email:</label>
        <input type="email" name="email" required>

        <label style="float:left;">Nama Pengguna:</label>
        <input type="text" name="username" required>

        <label style="float:left;">Kata Sandi:</label>
        <input type="password" name="password" id="password" required>
        
        <div style="display: flex; align-items: center; margin: 5px 0;">
            <input type="checkbox" id="showPassword" onclick="togglePassword()" style="width: auto; margin-right: 5px;">
            <label for="showPassword" style="font-size: 14px; cursor: pointer;">Lihat Password</label>
        </div>

        <button type="submit">Simpan User</button>
        <a href="profile.php" class="back-link">Kembali ke Profil</a>
    </form>

    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    }
    </script>
</body>
</html>