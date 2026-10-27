<?php
include 'koneksi.php';

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
        echo "Email sudah terdaftar.";
    } else {
        $insertQuery = "INSERT INTO login (email, username, password) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($insertQuery);
        $stmt->bind_param("sss", $email, $username, $password);
        if ($stmt->execute()) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            header("Location: profile.php");
            exit();
        } else {
            echo "Pendaftaran gagal.";
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School Health - Sign Up </title>
    <style>
        /* signup.css */
        body {
            background-color: #fff200; /* Warna kuning untuk latar belakang */
            font-family: 'Lucida Sans', sans-serif; /* Menggunakan font */
            color: #d90429; /* Warna merah untuk teks */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #d90429; /* Warna merah untuk latar belakang form */
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"],
        input[type="text"] { /* Tambahkan input type text */
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #fff;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box; /* Menjaga ukuran input */
        }

        /* CSS untuk checkbox */
        input[type="checkbox"] {
            cursor: pointer;
            margin-right: 5px;
        }

        /* Styling label untuk checkbox */
        label[for="showPassword"] {
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background-color: #fff200; /* Warna kuning untuk tombol */
            color: #d90429;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #f5c000; /* Warna kuning yang sedikit lebih gelap untuk efek hover */
        }
    </style>
</head>
<body>
    <!-- Form Signup -->
    <form action="signup.php" method="POST">
        <h2>Daftar</h2>
        Email: <input type="email" name="email" required><br>
        Nama Pengguna: <input type="text" name="username" required><br>
        Kata Sandi: <input type="password" name="password" id="password" required><br>
        
        <div style="display: flex; align-items: center;">
            <input type="checkbox" id="showPassword" onclick="togglePassword()">
            <label for="showPassword" style="margin-left: 5px;">Lihat Password</label>
        </div>

        <br>
        <button type="submit">Daftar</button>
        <div style="text-align: center; margin-top: 15px;">
            Sudah punya akun? 
            <a href="login.php" style="color: #fff200; text-decoration: italic;">Masuk</a>
        </div>
    </form>

    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password"; // Toggle type
    }
    </script>
</body>
</html>
