<?php
// Memasukkan file koneksi.php untuk menghubungkan ke database
include('koneksi.php');
// Mengambil id dari URL untuk menentukan produk yang akan diedit
$id = $_GET['id'];

// Mengambil data produk berdasarkan id
$query = "SELECT * FROM produk WHERE id_jasa = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika tombol submit ditekan, proses update data produk
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar_produk = $_FILES['gambar_produk']['name'];
    
    // Hapus gambar kalau kotak centang "Hapus Gambar" diklik
    if (isset($_POST['hapus_gambar']) && $_POST['hapus_gambar'] == 1) {
        $file_gambar_lama = 'images/gambar_crud/' . $data['gambar_produk'];
        if (file_exists($file_gambar_lama)) {
            unlink($file_gambar_lama);
        }
        // Hapus nama gambar produk dari database setelah dipencet submit
        $query_hapus_gambar = "UPDATE produk SET gambar = NULL WHERE id_jasa = $id";
        $result_hapus_gambar = mysqli_query($koneksi, $query_hapus_gambar);
    }

    // Jika ada gambar baru diupload
    if ($gambar_produk != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $gambar_produk);
        $ekstensi = strtolower(end($x));
        $file_temp = $_FILES['gambar_produk']['tmp_name'];
        $nama_gambar_baru = date('Y-m-d') . '-' . $gambar_produk;
         // Mengecek ekstensi gambar
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            // Memindahkan file gambar baru ke folder
            move_uploaded_file($file_temp, '../images/data_jasa/' . $nama_gambar_baru);
             // Update data produk ke database
            $query = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga=$harga, gambar='$nama_gambar_baru' WHERE id_jasa=$id";
            $result = mysqli_query($koneksi, $query);
            // Mengecek apakah query berhasil atau tidak
            if (!$result) {
                die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                echo "<script>document.location.href='kelola_jasa.php'</script>";
            } else {
                echo "<script>alert('Data berhasil diperbarui!');window.location='kelola_jasa.php';</script>";
                echo "<script>document.location.href='kelola_jasa.php'</script>";
            }
        } else {
            // Jika ekstensi gambar tidak sesuai
            echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');window.location='edit_produk.php?id=$id';</script>";
        }
    } else {
        // Jika tidak ada gambar baru diupload
        $query = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga=$harga WHERE id_jasa=$id";
        $result = mysqli_query($koneksi, $query);
          // Mengecek apakah query berhasil atau tidak
        if (!$result) {
            die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            echo "<script>document.location.href='kelola_jasa.php'</script>";
        } else {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
            echo "<script>document.location.href='kelola_jasa.php'</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Pengaturan tag head HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit_produk</title>
    <!-- Menghubungkan file CSS untuk tata letak dan desain -->
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="../style/style1.css">
     <!-- Gaya khusus untuk elemen checkbox -->
    <style>
            .hapus-gambar-checkbox {
        display: inline-block;
        align-items: left;
        width:30px;
    }
    </style>
</head>

    <body>
    <!-- header section starts -->
    <header>
          <!-- Tombol untuk menampilkan/menyembunyikan menu navigasi saat di perangkat kecil -->
        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>
        <a href="#" class="logo">Clean Clean</a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about us</a>
            <a href="#layanan">layanan</a>
            <?php if(!isset($_SESSION['login'])) {?>
                <a href="../views/login.php">Login</a>
            <?php } else {?>
                <a href="logout.php">Logout</a>

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
<!-- Form edit produk -->
<center><h1>Edit Produk</h1></center>
<form method="POST" action="" enctype="multipart/form-data">
    <section class="base">
        <div>
            <label>Nama Jasa Baru </label>
            <input type="text" name="nama" autofocus="" required="" value="<?php echo $data['nama']; ?>" /> 
        </div>
        <div>
            <label>Deskripsi Baru </label>
            <input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>" />
        </div>
        <div>
            <label>Harga Jasa Baru</label>
            <input type="number" name="harga" required="" min="100000" max="1000000" value="<?php echo $data['harga']; ?>" />
        </div>
        <div>
    <label>Gambar Produk Baru</label>
    <input type="file" name="gambar_produk" />
    <label>Gambar Lama</label>
    <?php if ($data['gambar'] != ""): ?>
    <img src="../images/data_jasa/<?php echo $data['gambar']; ?>" alt="Gambar Produk" width="100" height="100"> 
    <br><input class="hapus-gambar-checkbox" type="checkbox" name="hapus_gambar" value="1"/>Klik Untuk Setuju Hapus Gambar.
    <?php endif; ?>

    </div>
        <div>
            <button type="submit" name="submit">Simpan Perubahan</button>
        </div>
    </section>
</form>
<!-- Penggunaan mode gelap -->
<script>
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

