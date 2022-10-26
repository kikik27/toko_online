
<?php 

session_start();

if ($_SESSION['admin']!=true) {
    header("Location:../");

}
?>
<?php include "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>TOKO ONLINE</title>
</head>
<body>
    <div class="container col-10 py-5">
        <center style="font-size: 24px;"><?php echo "<h1><b>Selamat Datang, " . $_SESSION['nama'] ."  !"."</b></h1>"; ?></center>
        
        <div class="card-deck py-5">
          <div class="card col-3 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3225/3225084.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Pelanggan</h4>
              <a href="pelanggan.php" class="btn btn-warning btn-lg">Go</a></a>
            </div>
          </div>
          <div class="card col-4 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/2916/2916066.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Petugas</h4>
              <a href="petugas.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
          <div class="card col-4 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/679/679922.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Data Barang</h4>
              <a href="produk.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
          <div class="card col-4 py-5">
            <img src="../gambar/report (1).png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Pesanan</h4>
              <a href="pesanan.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
          <div class="card col-4 py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/3292/3292957.png" alt="" class="card-img">
            <div class="card-body" style="text-align: center;">
              <h4 class="card-text py-3">Laporan</h4>
              <a href="laporan.php" class="btn btn-warning btn-lg">Go</a>
            </div>
          </div>
        </div>

    </div>

</body>
<?php
include "../footer.php";
?>
</html>