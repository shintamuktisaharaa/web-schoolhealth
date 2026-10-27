<?php
include 'koneksi.php';

session_start(); // Pastikan session dimulai di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login WHERE email = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Login gagal. Email atau password salah.";
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My School Health - Log In</title>
  <style>
    body {
        background-color: #f7f6fc; /* Latar belakang abu-ungu sangat soft */
        font-family: 'Lucida Sans', sans-serif;
        color: #4b4453; /* Warna teks utama */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background-color: #ffffff; /* Latar belakang form putih bersih */
        color: #4b4453; /* Warna teks dalam form */
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(140, 122, 230, 0.08); /* Bayangan ungu soft */
        width: 300px;
        text-align: center;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #dcd6f7; /* Garis tepi ungu soft */
        border-radius: 6px;
        font-size: 16px;
        box-sizing: border-box;
        background-color: #fbf9ff; /* Ungu sangat muda untuk input */
        color: #4b4453;
    }

    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="text"]:focus {
        border-color: #a8e6cf; /* Hijau soft saat fokus */
        outline: none;
        box-shadow: 0 0 5px rgba(168, 230, 207, 0.5);
    }

    /* CSS untuk checkbox */
    input[type="checkbox"] {
        cursor: pointer;
        margin-right: 5px;
        accent-color: #8c7ae6; /* Memberikan aksen warna ungu pada checkbox */
    }

    /* Styling label untuk checkbox */
    label[for="showPassword"] {
        display: inline-block;
        cursor: pointer;
        font-size: 14px;
        color: #55535c;
    }

    button {
        background-color: #a8e6cf; /* Hijau soft untuk tombol */
        color: #2d3436;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }

    button:hover {
        background-color: #88d4bc; /* Hijau soft lebih gelap saat hover */
    }

    .error-message {
        color: #e056fd; /* Warna soft yang kontras untuk pesan kesalahan */
        margin-bottom: 15px;
        font-size: 14px;
    }
</style>
</head>
<body>
    <form action="login.php" method="POST">
        <h2>Masuk</h2>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Kata Sandi:</label>
        <input type="password" name="password" id="password" required><br>
        
        <div style="display: flex; align-items: center;">
            <input type="checkbox" id="showPassword" onclick="togglePassword()">
            <label for="showPassword" style="margin-left: 5px;">Lihat Password</label>
        </div>

        <button type="submit">Masuk</button>
         </form>

    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    }
    </script>
</body>
</html>
