// Memasukkan file koneksi.php untuk menghubungkan ke database
<?php include('koneksi.php');
session_start(); // Mulai sesi

// Mengatur peran pengguna sebagai admin
$_SESSION['role'] = 'admin';

// Periksa apakah pengguna telah masuk. Jika tidak, arahkan ke halaman login.
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Periksa peran pengguna. Jika bukan admin, arahkan ke halaman lain atau tampilkan pesan kesalahan.
if ($_SESSION['role'] !== 'admin') {
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Pengaturan karakter dan tampilan halaman -->
    <link rel="stylesheet" href="../style/style2.css">
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="../style/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a class="btn"  href="../views/index.php">home</a>
            <a class="btn" href="../views/index.php">about us</a>
            <a class="btn" href="../views/index.php">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/login.php">Login</a>
            <?php } else {?>
                <a class="btn" href="logout.php">Logout</a>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>

                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

    <center><h1><b>Data Layanan</b></h1></center>
    <br>
<?php
// Menentukan ZONA WITA
date_default_timezone_set('Asia/Makassar');
?>

    <div class="tanggal">
        <center>
            <p>Tanggal: <?php echo date('l, d F Y'); ?></p>
            <p>Waktu: <?php echo date('H:i:s'); ?></p>
        </center>
    </div>
        <!-- pilihan crud -->
        <div class="crud">
            <h1>  </h1>
            
                <div class="btn-kelola">
                    <button> <a href="index.php">Kembali</a> </button>
                    <button> <a href="tambahjasa.php">Tambah</a> </button>
                </div>
    
            <!-- Tabel untuk menampilkan data jasa layanan -->
            <table>
                <thead>
                    <tr>
                        <th> No. </th>
                        <th> Gambar </th>
                        <th> Nama </th>
                        <th> Deskripsi </th>
                        <th> Harga </th>
                        <th colspan="2"> Kelola </th>
                    </tr>
                </thead>
                <?php 
                 // Menampilkan data produk dari database
                    if (isset($_GET["search"])) {
                        $keyword = $_GET["cari"];
                        
                    }
                    else {
                        $result = mysqli_query( 
                                    $koneksi, "SELECT * FROM produk");
                    }

                    $products = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $products[] = $row;
                    }
                    $i = 1; 
                    foreach ($products as $product):
                ?>
                <tr>
                    <td> <?php echo $i ;?> </td>
                    <td> <img src="../images/data_jasa/<?= $product["gambar"] ?>" width="100px" alt=""> </td>
                    <td> <?php echo $product['nama'] ;?> </td>
                    <td> <?php echo $product['deskripsi'] ;?> </td>
                    <td> Rp. <?php echo $product['harga'] ;?> </td>
                    <td>
                        <!-- Tombol untuk mengedit data produk -->
                        <a href="edit_produk.php?id=<?php echo $product['id_jasa']; ?>">Edit &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        &nbsp;
                        <!-- Tombol untuk menghapus data produk -->
                        <a href="hapus_produk.php?id=<?php echo $product['id_jasa']; ?>" onclick="return confirm('Anda yakin ingin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    $i++; 
                    endforeach;
                ?>
            </table>
        </div>
    </div>    
</body>
<!-- memanggil javascript -->
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>
