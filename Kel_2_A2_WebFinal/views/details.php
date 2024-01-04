<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Pengaturan tag head HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
       <!-- Menghubungkan file CSS untuk tata letak dan desain -->
    <link rel="stylesheet" href="../style/detail-produk.css">
    <link rel="stylesheet" href="../style/tambahjasa.css">
    <link rel="stylesheet" href="../style/style1.css">
     <!-- Menghubungkan library Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
 <!-- Bagian header halaman web -->
<header>
     <!-- Tombol untuk menampilkan/menyembunyikan menu navigasi saat di perangkat kecil -->
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
         <!-- Navigasi halaman web -->
        <nav class="navbar">
            <a class="btn" href="../views/index.php">home</a>
            <a class="btn" href="../views/index.php">about us</a>
            <a class="btn" href="../views/index.php">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/logout.php">Logout</a>
            <?php } else {?>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>
                    <a href="kritiksaran.php" class="btn">Kritik & Saran</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
            <!-- Mode gelap -->
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>
<!-- animasi bergerak -->
    <div class="segitiga-bergerak">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
    </div>
<!-- Bagian utama halaman web -->
    <main>
    <?php
    // Memasukkan file koneksi.php untuk menghubungkan ke database
        include('../views/koneksi.php');
        // Mengambil id dari URL
        $id = $_GET['id'];
          // Mengambil data produk dari database berdasarkan id
        $result = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_jasa = $id");
        // Menyimpan data produk ke dalam array
        $data_produk = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_produk[] = $row;
        }
         // Menampilkan detail produk
        foreach ($data_produk as $produk)
        ?>
        <div class="home">
        <div class="container">
            <div class="product-div">
                 <!-- Bagian kiri dari tampilan produk -->
                <div class = "product-div-left">
                    <div class = "img-container">
                          <!-- Menampilkan gambar produk -->
                        <img src = "../images/data_jasa/<?php echo $produk['gambar']?>" alt = "Item 1">
                    </div>
                </div>
                 <!-- Bagian kanan dari tampilan produk -->
                <div class = "product-div-right">
                    <!-- Menampilkan nama produk -->
                    <span class = "product-name"><?php echo $produk['nama'];?></span>
                    <!-- Menampilkan harga produk -->
                    <span class = "product-price">Rp <?php echo number_format($produk['harga'],0,'.','.');?></span>
                     <!-- Menampilkan deskripsi produk -->
                    <span class = "product-description">Deskripsi : <?php echo $produk['deskripsi'];?></span>
                    <!-- Tautan untuk memesan produk -->
                    <a href="tambah_order.php?id=<?php echo $produk['id_jasa'] ?>" class="btn-produk">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </main>
        </div>
        
</body>
<!-- Menghubungkan file JavaScript -->
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>