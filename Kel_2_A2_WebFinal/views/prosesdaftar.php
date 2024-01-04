<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $role = 'pelanggan'; 

    if ($password === $konfirmasi) {
        $query = "INSERT INTO akun (username, password, role) VALUES (?,?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
            if (mysqli_stmt_execute($stmt)) {
                // Registrasi berhasil
                header("location: ../views/login.php");
                exit;
            } else {
                // Kesalahan saat mengeksekusi pernyataan SQL
                echo "Error: " . mysqli_error($koneksi);
            }
            mysqli_stmt_close($stmt);
        } else {
            // Terjadi kesalahan dalam persiapan pernyataan SQL
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        // Password dan konfirmasi password tidak sesuai
        echo "Password dan konfirmasi password tidak sesuai.";
    }
}
?>
