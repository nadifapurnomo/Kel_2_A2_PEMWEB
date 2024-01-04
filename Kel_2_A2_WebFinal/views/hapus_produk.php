
<!--  Memasukkan file koneksi.php untuk menghubungkan ke database -->
<?php include('koneksi.php');
// Mengambil id dari URL untuk menentukan data produk yang akan dihapus
    $id = $_GET['id'];
    // Query untuk menghapus data produk berdasarkan id
    $query = "DELETE FROM produk where id_jasa ='$id'";
    $result = mysqli_query($koneksi, $query);
    // Mengecek apakah query berhasil atau tidak
    if(!$result) {
         // Jika query tidak berhasil, tampilkan pesan error dan kembali ke halaman kelola_jasa
        die("Querry Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        echo"<script>document.location.href='kelola_jasa.php'</script>";

    } else {
         // Jika query berhasil, tampilkan pesan sukses dan kembali ke halaman kelola_jasa
        echo "<script>alert('Data berhasil dihapus!);</script>";
        echo"<script>document.location.href='kelola_jasa.php'</script>";
    }

?>