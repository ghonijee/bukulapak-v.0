<?php
require "control/connect.php";
require "control/fungsi.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['login'])) {
    login($_POST);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-">
    <title>BUKULAPAK</title>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/script.js"></script>
    <style>
        #produk:hover {
            transform: scale(1.1);
            transition-property: transform;
            transition-duration: .5s;
        }
    </style>
</head>

<body>
    <?php require_once 'template/navbar.php'; ?>
    <div id="content">
        <header>
            <div class="container" style="margin-top:105px;">
                <div class="row">
                    <div class="col-8">
                        <div id="demo" class="carousel slide border" data-ride="carousel">
                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="#">
                                        <img src="img/1.png" class="w-100" alt="buku1">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="#">
                                        <img src="img/2.png" class="w-100" alt="buku2">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a href="#">
                                        <img src="img/3.jpg" class="w-100" alt="buku3">
                                    </a>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>

                    </div>
                    <div class="col-4">
                        <img src="img/side1.jpg" class='w-100'>
                        <img src="img/side2.jpg" class='mt-3 w-100'>
                    </div>
                </div>
            </div>
        </header>
        <!-- <hr class="w-75"> -->
        <div class="container mt-4">
            <h4 class="text-light text-center badge-info p-3 rounded">Katalog Buku</h4>
            <!-- <hr class="w-100"> -->
            <div class="row m-4">
                <?php 
            $tampildata = 18;
            $halamanaktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $awal = ($halamanaktif > 1 ) ? ($halamanaktif * $tampildata ) - $tampildata : 0 ;
            $jumlahdata = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM buku"));
            $jumlahhalaman = ceil($jumlahdata / $tampildata);
            $query = mysqli_query($connection, "SELECT * FROM buku LIMIT $awal, $tampildata"); 
            // for ($i=1 ; $i <= $jumlahhalaman ; $i++){
            //     echo "<a href='?halaman=$i'>$i</a>";
            // }
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
        ?>
                <div class="col-12 col-sm-6 col-md-3 col-lg-2 text-center mt-4">
                    <div class="card p-1" id="produk">
                        <a href="detail_buku.php?kd_buku=<?php echo $data['kd_buku']; ?>" style="text-decoration: none;">
                            <img src="img/katalog/<?php echo $data['foto']; ?>" class="card-img-top" style="height: 200px;">
                            <p class="card-title mt-3 mb-0 text-truncate">
                                <?php echo $data['judul_buku']; ?>
                            </p>
                            <p class="text-muted m-1 small text-truncate">
                                <?php echo $data['kategori']; ?>
                            </p>
                            <p class="text-dark card-text">Rp.
                                <?php echo $data['harga']; ?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php
    }
} ?>
            </div>
            <div class="offset-5 col">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href='?halaman=<?php echo $halamanaktif-1; ?>'>&laquo;</a></li>
                <?php for ($i=1 ; $i <= $jumlahhalaman ; $i++){ ?>
                <li class="page-item">
                    <a class="page-link" href='?halaman=<?php echo $i ?>'>
                        <?php echo $i ?></a>
                </li>
                <?php } ?>
                <li class="page-item"><a class="page-link" href='?halaman=<?php echo $halamanaktif+1; ?>'>&raquo;</a></li>
            </ul>
            </div>
        </div>
    </div>
    <!-- <hr class="w-75"> -->
    <?php require_once 'template/footbar.php'; ?>
    <!-- <script src="js/jquery-3.3.1.js"></script> -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/script.js"></script> -->
    <script>
    </script>
</body>

</html>