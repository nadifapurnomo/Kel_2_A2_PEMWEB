<?php
// Memulai sesi
session_start();
// Memasukkan file koneksi.php yang berisi konfigurasi koneksi ke database
include 'koneksi.php';

// Mengambil informasi pengguna dari sesi
$id_user = $_SESSION['id_user'];

$username = $_SESSION['username'];

// Mengambil id jasa dari parameter URL
$idService = $_GET["id"];
// Menjalankan query untuk mendapatkan data jasa berdasarkan id
$queryService = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_jasa = $idService");

$dataService = mysqli_fetch_assoc($queryService);

// Memproses formulir jika tombol submit ditekan
if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $number_phone = $_POST['number_phone'];
    $jasa = $_POST['jasa'];
    $address = $_POST['address'];
    $date_order = $_POST['date_order'];

     // Menjalankan query untuk menyimpan data order ke database
    $query = "INSERT INTO `order` (`id`, `id_akun` , `name`, `number_phone`, `address`, `jasa`, `date_order`) VALUES (NULL, $id_user , '$name',  '$number_phone', '$address', '$jasa','$date_order')";
    $result = mysqli_query($koneksi, $query);
     // Memeriksa apakah query berhasil dijalankan
    if (!$result) {
        // Menampilkan pesan kesalahan jika query gagal
        die("Querry Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        echo "<script>document.location.href='dataorder.php';</script>";
    } else {
        // Menampilkan pesan sukses jika query berhasil
        echo "
        <script>
        alert('Berhasil Melakukan Pesanan!');
        document.location.href = 'dataorder.php';
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah_order</title>
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>


    <body>
    <!-- header section starts -->
    <header>
        <!-- Navigation Bar -->
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a class="btn" href="index.php">home</a>
            <a class="btn" href="#about">about us</a>
            <a class="btn" href="#layanan">layanan</a>
            <a class="btn" href="../views/logout.php">Logout</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/logout.php">Logout</a>
            <?php } else {?>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="data_order.php" class="btn">Order</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                    <a href="data.php" class="btn">Data</a>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

    <!-- Main Content - Tambah Order -->
    <center><h1>Tambah Order</h1></center>

    <form method="POST" action="" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?= $username ?>" readonly required="" />
            <input type="hidden" name="id_user" value="<?= $id_user ?>"> 
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" autofocus="" required="" /> 
        </div>
        <div>
            <label>Number Phone</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="10" maxlength="13" name="number_phone" />
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" required="" />
        </div>
        <div>
            <label>Date Order</label>
            <input type="date" name="date_order" required="" />
        </div>
        <div>
            <label>Jasa</label>
            <input type="text" value="<?= $dataService["nama"] ?>" name="jasa" readonly required="" />
        </div>
    </form>
    <div>
        <button type="submit" name="submit">Simpan</button>
        <a href="../views/index.php" class="btn-back">Batal</a>
    </div>
</section>

</body>
<!-- memanggil java script untuk mode -->
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>