<?php include('koneksi.php');
session_start(); // Mulai sesi

$_SESSION['role'] = 'pelanggan';

// Periksa apakah pengguna telah masuk. Jika tidak, arahkan ke halaman login.
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Periksa peran pengguna. Jika bukan usser, arahkan ke halaman lain atau tampilkan pesan kesalahan.
if ($_SESSION['role'] !== 'pelanggan') {
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Pengaturan tag head HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data order</title>
    <!-- Menghubungkan file CSS untuk tata letak dan desain -->
    <link rel="stylesheet" href="../style/dataorder.css">
    <link rel="stylesheet" href= "../style/style1.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
</head>
<body>
 <!-- Bagian header halaman web -->
    <header>
        <!-- Tombol untuk menampilkan/menyembunyikan menu navigasi saat di perangkat kecil -->
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a class="btn" href="../views/index.php">home</a>
            <a class="btn" href="../views/index.php">about us</a>
            <a class="btn" href="../views/index.php">layanan</a>
            <!-- Pengecekan Sesi dan Peran Pengguna -->
            <?php if(!isset($_SESSION['login'])) {?>
                <a class="btn" href="../views/login.php">Login</a>
            <?php } else {?>
                <a class="btn" href="logout.php">Logout</a>

                <?php if ($_SESSION['role']=='pelanggan'):?>
                    <a class="btn" href="dataorder.php" class="btn">Order</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>


    <br>
<?php
// Menentukan ZONA WITA
date_default_timezone_set('Asia/Makassar');
?>

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
            <?php if(!isset($_SESSION['login'])) {?>
                <a href="login.php" class="btn">Login</a>
            <?php } else {?>
                        <?php if ($_SESSION['role']=='admin'):?>
                            <a href="data.php" class="btn"><h4>Kelola Data Pesanan</h4></a>
                            <br>
                            <a href="kelola_jasa.php" class="btn"><h4>Kelola Data Jasa</h4></a>
                            <br>
                <?php endif ?>
            <?php } ?>
        </div>
        <div class="images">
            <img src="../images/home.png" class="header-img" alt="" width="100%">
        </div>
    </section>
    <div class="container">

        <?php 
        // Mengambil data pesanan dari database
            $query = mysqli_query($koneksi, "SELECT * FROM produk");

            while($row = mysqli_fetch_assoc($query)) {
                $products[] = $row;
            }
        ?>

        <?php foreach($products as $product) :?>
            <div class="box">
                <a href="details.php?id=<?= $product["id_jasa"] ?>">
                    <img src="../images/data_jasa/<?= $product["gambar"] ?>" alt="Item <?= $product["id_jasa"] ?>">
                </a>
                    <p><?= $product["nama"] ?></p>
                </div>
        <?php endforeach ?>
    </div>

    <script>
        const toggler = document.getElementById('toggler');
        const navbar = document.querySelector('.navbar');

        toggler.addEventListener('click', function () {
            if (this.checked) {
                navbar.style.display = 'block';
            } else {
                navbar.style.display = 'none';
            }
        });
    const icon = document.getElementById("icon");
    icon.addEventListener("click", function () {
        document.body.classList.toggle("dark-theme");
        if (document.body.classList.contains("dark-theme")) {
            icon.src = "../images/sun.png";
        } else {
            icon.src = "../images/moon.png";
        }
    });
</script>
                    
</body>

</html>


