<?php
 // Informasi koneksi ke database
    $host = "localhost"; // Nama host database, dalam hal ini localhost
    $user = "root"; // Nama pengguna database
    $pass = "";  // Kata sandi pengguna database, kosong karena menggunakan pengaturan default
    $db = "project_akhir"; // Nama database yang ingin dihubungkan

     // Membuat koneksi ke database menggunakan fungsi mysqli_connect
    $koneksi = mysqli_connect($host, $user, $pass, $db);
// Memeriksa apakah koneksi berhasil
if(!$koneksi) {
     // Jika koneksi gagal, tampilkan pesan kesalahan dan hentikan eksekusi script
    die("Koneksi dengan database gagal: ".mysqli_connect_error());
} 
?>