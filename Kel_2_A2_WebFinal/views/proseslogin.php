<?php
// Membutuhkan file koneksi.php yang berisi konfigurasi koneksi ke database
require 'koneksi.php';
// Memulai sesi
session_start();

// Memeriksa apakah metode permintaan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Mendapatkan nilai username dan password dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menyiapkan query SQL untuk mengambil data akun berdasarkan username dan password
    $query = "SELECT * FROM akun WHERE username=? AND password=?";
$stmt = mysqli_prepare($koneksi, $query);

 // Memeriksa apakah persiapan pernyataan SQL berhasil
if ($stmt) {
     // Mengikat parameter ke pernyataan SQL
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    // Mengeksekusi pernyataan SQL
    mysqli_stmt_execute($stmt);
    // Mendapatkan hasil query
    $result = mysqli_stmt_get_result($stmt);

     // Memeriksa apakah terdapat satu baris data yang sesuai dengan kriteria
    if (mysqli_num_rows($result) == 1) {
         // Mendapatkan data akun
        $row = mysqli_fetch_assoc($result);
        // Menyimpan data pengguna dalam sesi
        $_SESSION['username'] = $row["username"];
        $_SESSION['id_user'] = $row['id_akun'];
        $_SESSION['role'] = $row['role']; 
        $_SESSION['login'] = true;
        // Mengarahkan pengguna ke halaman yang sesuai dengan peran (pelanggan atau admin)
        if ($_SESSION['role'] === 'pelanggan') {
            header("location: index.php");
        } else if ($_SESSION['role'] === 'admin') {
            header("location: ../views/index.php");
        } else {
            // Menampilkan pesan kesalahan jika username atau password tidak sesuai
            $error = "Peran tidak valid.";
        }
    } else {
        echo "
        <script>
        alert('Username atau password salah!');
        document.location.href='login.php';
        </script>
        ";
    }
    mysqli_stmt_close($stmt);
} else {
    $error = "Terjadi kesalahan dalam persiapan pernyataan SQL.";
}

}
