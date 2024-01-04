<?php include('koneksi.php');
session_start(); // Mulai sesi

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data</title>
    <link rel="stylesheet" href="../style/style1.css">
    <link rel="stylesheet" href="../style/style2.css">
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
                    <a href="kritiksaran.php" class="btn">Kritik & Saran</a>
                    <?php endif ?>
                <?php if ($_SESSION['role']=='admin'):?>
                <?php endif ?>
            <?php } ?>
        </nav>
        
        <div class="mode">
            <img src="../images/moon.png" id="icon">
        </div>
    </header>

    <center><h1><b>Data Pesanan</b></h1></center>
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

    <div class="btn-kelola">
        <button> <a href="index.php">Kembali</a> </button>
    </div>

    <br>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Nomor Telpon</th>
                <th>Alamat</th>
                <th>Jasa</th>
                <th>Date Order</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                $query = "SELECT * FROM `order` JOIN `akun` ON order.id_akun = akun.id_akun ORDER BY order.name ASC";
                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['number_phone']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['jasa']?></td>
                    <td><?php echo $row['date_order']?></td>
                    <td>
                        <a href="edit_order.php?id=<?php echo $row['id']; ?>">Edit &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        &nbsp;
                        <a href="hapus_order.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
                </table>
                    
</body>
<script text="text/javascript" src="../js/javascripts.js"></script>
</html>


