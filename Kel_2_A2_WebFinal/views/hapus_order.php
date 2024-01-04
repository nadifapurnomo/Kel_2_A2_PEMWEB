
// Memasukkan file koneksi.php untuk menghubungkan ke database
<?php include('koneksi.php');
// Mengambil id dari URL untuk menentukan data order yang akan dihapus
    $id = $_GET['id'];
    // Query untuk menghapus data order berdasarkan id
    $query = "DELETE FROM `order` where `id` ='$id'";
    $result = mysqli_query($koneksi, $query);
    // Mengecek apakah query berhasil atau tidak
    if(!$result) {
         // Jika query tidak berhasil, tampilkan pesan error dan kembali ke halaman data
        die("Querry Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        echo"<script>document.location.href='data.php'</script>";

    } else {
          // Jika query berhasil, tampilkan pesan sukses dan kembali ke halaman data
        echo "<script>alert('Data berhasil dihapus!);</script>";
        echo"<script>document.location.href='data.php'</script>";
    }

?>