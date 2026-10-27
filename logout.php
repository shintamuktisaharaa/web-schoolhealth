<?php
session_start();

// Menghentikan sesi untuk logout
session_unset();
session_destroy();

// Redirect ke halaman index setelah logout
header("Location: index.php");
exit();
?>
