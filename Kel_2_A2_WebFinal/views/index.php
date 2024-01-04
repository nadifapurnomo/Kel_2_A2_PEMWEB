<?php
// Memulai sesi untuk pengelolaan data pengguna
session_start(); 
// Memasukkan file koneksi.php untuk menghubungkan ke database
include "koneksi.php";
// Mengambil data produk dari tabel produk
$query = mysqli_query($koneksi, "SELECT * FROM produk");
// Menyimpan data produk ke dalam array
while ($row = mysqli_fetch_assoc($query)){
    $products[] = $row;
}

?>

<!-- HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Pengaturan karakter dan tampilan halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clean Clean</title>
    <!-- Link ke file CSS eksternal -->
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="../style/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- header section starts -->
    <header>
        <!-- Checkbox untuk tombol navigasi responsif -->
        <input type="checkbox" name="" id="toggler">
        <!--  Label untuk ikon navigasi responsif   -->
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <!-- Navigasi situs -->
        <nav class="navbar">
            <a class="btn" href="#home">home</a>
            <a class="btn" href="#about">about us</a>
            <a class="btn" href="#layanan">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                 <!-- Tampilkan tombol login jika tidak ada sesi aktif -->
                <a class="btn" href="../views/login.php">Login</a>
            <?php } else {?>
                 <!-- Tampilkan tombol logout jika ada sesi aktif -->
                <a class="btn" href="logout.php">Logout</a>
                <!-- Tampilkan menu sesuai peran pengguna -->
                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <!-- Mode tema gelap atau terang -->
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>
    <!-- Efek animasi bergerak -->
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
<!-- header section ends -->

<!-- home section starts  -->
    <section class="home" id="home">
        <div class="contents">
            <h3>
                Mau Kami Buat Hunian Anda Bersih?
            </h3>
            <!-- Tampilkan tombol login jika tidak ada sesi aktif -->
            <?php if(!isset($_SESSION['login'])) {?>
                <a href="login.php" class="btn">Login</a>
            <?php } else {?>
                 <!-- Tampilkan menu sesuai peran pengguna -->
                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a href="dataorder.php" class="btn">Order</a>
                            <?php endif ?>
                        <?php if ($_SESSION['role']=='admin'):?>
                            <a href="data.php" class="btn"><h4>Kelola Data Pesanan</h4></a>
                            <br>
                            <a href="kelola_jasa.php" class="btn"><h4>Kelola Data Jasa</h4></a>
                            <br>

                <?php endif ?>
            <?php } ?>
        </div>
        <!-- Gambar dekoratif pada halaman home -->
        <div class="images">
            <img src="../images/home.png" class="header-img" alt="" width="100%">
        </div>
    </section>
<!-- home section ends -->

<!-- about section starts -->
<section class="about" id="about">
    <h1 class="heading">
         <!-- Judul halaman about us -->
        <span> About</span> Us
    </h1>
    <!-- Container tentang informasi Clean Clean -->
    <div class="aboutUs">
        <div class="image">
            <img src="../images/about.png" alt="Gambar">
        </div>
         <!-- Kotak deskripsi tentang kami -->
        <div class="description-box">
        <div class="description">
            <h2>Clean Clean</h2>
            <p>Clean Clean adalah penyedia jasa kebersihan untuk rumah, apartemen dan berbagai tempat yang membutuhkan pembersih profesional.</p>
            <br>
            <p>Tujuan kami adalah menyediakan solusi kebersihan berstandar tinggi untuk membuat tempat tinggal Anda bersih dan nyaman.</p>
        </div>
        </div>
    </div>

 <!-- Kotak deskripsi tentang kami -->
    <div class="title">Why Clean Clean?</div>
     <!-- Container fleksibel untuk menyajikan alasan -->
        <div class="container">
            <div class="item">
                <img src="../images/why1.png" alt="Item 1">
                <p>Our partners are professionally trained</p>
            </div>
            <div class="item">
                <img src="../images/why2.png" alt="Item 2">
                <p>Customer journey and satisfaction are our prioritization</p>
            </div>
            <div class="item">
                <img src="../images/why3.png" alt="Item 3">
                <p>Standby customer service to oversee during the procedure</p>
            </div>
            <div class="item">
                <img src="../images/why4.png" alt="Item 4">
                <p> On demand feature, same day service</p>
            </div>
            <div class="item">
                <img src="../images/why5.png" alt="Item 5">
                <p>Guaranteed Assurance for Losses and Unforeseen Incidents</p>
            </div>
            <div class="item">
                <img src="../images/why6.png" alt="Item 6">
                <p> Subscribe package, pay less get more services</p>
            </div>
        </div>
</section>
<!-- about section ends -->

<!-- Section Layanan starts -->
<section class="layanan" id="layanan">
    <h1 class="heading">
         <!-- Judul halaman layanan -->
        <span>Layanan Kami</span>
    </h1>
    <!-- Container untuk menampilkan layanan -->
    <div class="container">
        <!-- Menampilkan produk-produk dari database -->
        <?php foreach($products as $product) :?>
        <div class="box">
            <img src="../images/data_jasa/<?= $product["gambar"] ?>" alt="Item <?= $product["id_jasa"] ?>">
            <p><?= $product["nama"] ?></p>
        </div>
        <?php endforeach ?>
        
    </div>
    
</section>
<!-- Section Layanan ends -->
<!-- footer section starts -->
<section class="footer">
    <!-- Container box untuk menampilkan tautan dan informasi -->
    <div class="box-container">
        <div class="box-footer">
            <h3>Quick Links</h3>
            <a class="btn" href="../views/index.php">home</a>
            <a class="btn" href="#about">about us</a>
            <a class="btn" href="#layanan">layanan</a>
            <a class="btn" href="#login">login</a>
        </div>
        <div class="box-footer">
            <h3>Location</h3>
            <a class="btn" href="https://www.google.co.id/maps/@-0.4947968,117.1357696,14z?entry=ttu">Samarinda</a>
            <a
            class="btn" href="https://www.google.co.id/maps/place/Balikpapan,+Kota+Balikpapan,+Kalimantan+Timur/@-1.174603,116.841748,11z/data=!3m1!4b1!4m6!3m5!1s0x2df14710964d9c91:0xcaa6ec96c2aea6d2!8m2!3d-1.2379274!4d116.8528526!16zL20vMDJsYjZ4?entry=ttu">Balikpapan</a>
            <a
            class="btn" href="https://www.google.co.id/maps/place/Surabaya,+Jawa+Timur/@-7.1282662,112.815134,12.5z/data=!4m6!3m5!1s0x2dd7fbf8381ac47f:0x3027a76e352be40!8m2!3d-7.2574719!4d112.7520883!16zL20vMDFmNHhk?entry=ttu">Surabaya</a>
            <a
            class="btn" href="https://www.google.co.id/maps/place/Denpasar,+Kota+Denpasar,+Bali/@-8.6726833,115.2242733,12z/data=!3m1!4b1!4m6!3m5!1s0x2dd2409b0e5e80db:0xe27334e8ccb9374a!8m2!3d-8.6704582!4d115.2126293!16zL20vMDJuYmgx?entry=ttu">Denpasar</a>
        </div>
        <div class="box-footer">
            <h3>Contact Info</h3>
            <a class="btn" href="mailto:raudhya.zhra@gmail.com?subject=Saya%20ingin%20berbicara%20dengan%20Admin%20CleanClean">cleanclean@gmail.com</a>
            <a class="btn" href="https://www.google.co.id/maps/@-0.4947968,117.1357696,14z?entry=ttu">Samarinda, Indonesia</a>
            <a class="btn" href="https://api.whatsapp.com/send?phone=6282158467838&text=Halo%20CleanClean,%20Saya%20ingin%20berbicara%20dengan%20admin">Contact Service</a>
        </div>
    </div>
    <div class="credit"> Kelompok 2
        <span> A2 2022 </span>
        <p>
            <br>
                Raudhya Azzahra'- Hasbi Rizky Rahmadani - Nadifa Salsabila Purnomo - Agsel Falana Suparlan Putra
        </p>
    </div>
</section>
<!-- footer section ends -->
</body>
<script text="text/javascript" src="../js/javascripts.js"></script>

</html>