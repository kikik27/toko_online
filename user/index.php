
<?php 

session_start();

if ($_SESSION['user']!=true) {
    header("Location:../");


}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container col-11">
            <a class="navbar-brand" href="index.php">PT. DEVARO SEJAHTERA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">


            </ul>

            <form action="" method="post" class="form-inline" style="float: left">

            <input name="search" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" value="<?php
            if(isset($_POST['cari'])){
            echo $_POST['search'];
            }
            ?>">
            
            <button name="cari" class="btn btn-outline-success my-2 mr-sm-5" type="submit">Search</button>

            </form>
        
            <form action="" method="post">
        <span class="navbar-text">
        <a href="keranjang.php" class="btn btn-primary">Keranjang</a>
        <a href="history.php" class="btn btn-info">Pesanan</a>
        <input type="submit" name="logout" value="Logout" class="btn btn-danger">


        </span>
        </form>
        
        </div>
        </div>
    </nav>  

    <style>
        *{
            font-family: "Oswald",sans-serif;
            font-weight: medium;
        }
        .navbar-brand{
            font-family: "Oswald",sans-serif;
            font-size: 24px;
            font-weight: bold ;
        }
        .nav-link{
            font-family: "Oswald",sans-serif;
            font-size: 16px;
        }
    </style>
            <?php 
        
        if(isset($_POST['logout'])){
        session_destroy();
        header("Location:../");
        }
        
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>PT. DEVARO JAYA</title>
</head>
<body>

<div class="container col-11 mb-5">
    <div class="row" id="load_data">
      
    

    <?php
      include "../koneksi.php";
    if(isset($_POST['cari'])){
      $cari = $_POST['search'];
      $data = mysqli_query($konn,"select * from produk where nam_produk like '%".$cari."%' OR kategori like '%".$cari."%'");				
    }else{
      $data = mysqli_query($konn,"select * from produk");		
    }
    $no = 1;
    $row = mysqli_num_rows($data);
    if ($row < 1){
      ?>
      <div class="col-12 py-5">
      <center>
        <h1 style="color:red;">
          <b>
            Mohon Maaf, Produk Yang Anda Cari Tidak Ditemukan
          </b>
        </h1>
      </center>
      </div>

      <?php
    }else{
    ?>
    <div class="col-12 py-5">
      <center>
        <h1>
            <b>Hi <span><?php echo $_SESSION['nama']?></span>
          </br> Selamat Datang Dan Selamat Berbelanja. Semoga Harimu Menyenangkan :) 
            </b>
        </h1>
      </center>
    </div>
    <?php

      while($d = mysqli_fetch_array($data)){
        $id = $d["id_produk"];
        $foto = $d["foto_produk"];
        $kategori = $d["kategori"];
        $nama = $d["nam_produk"];
        $harga = $d["harga"];
      ?>
    
            <div class="col-sm-3 mb-5">
              <div class="card">
                <img src="../gambar/<?php echo $foto?>" class="card-img-top" alt="gambar">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $nama; ?></h5>
                  <p class="card-text"><?php echo $kategori; ?></p>
                </div>
                <div class="card-footer" style="align-content: center;">
                    <h4><?php echo "Rp.".$harga ?></h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#beli<?php echo $id?>">BELI</button>
                  </div>
              </div>
            </div>

        <!-- Modal Beli -->
          <div class="modal fade" id="beli<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Beli <?php echo $nama?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

              <div class="row">
                  <div class="col-md-4">
                      <img src="../gambar/<?php echo $foto?>" class="card-img-top">
                  </div>

                  <div class="col-md-8">
                      <form action="" method="post">
                          <table class="table table-hover table-striped">
                              <thead>
                                  <tr>
                                      <input type="hidden" name="id" value="<?php echo $id?>">
                                      <input type="hidden" name="harga" value="<?php echo $harga?>">
                                      <td>Kategori</td><td><?php echo $kategori?></td>
                                  </tr>
                                  <tr>
                                      <td>Harga</td><td><?php echo $harga?></td>
                                  </tr>
                                  <tr>
                                      <td>Banyak</td><td><input type="number" name="qty" value="1"></td>
                                  </tr>
                              </thead>
                          </table>
                      
                  </div>
              </div>

              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-info" name="keranjang" value="Masukkan Keranjang">
                <input type="submit" class="btn btn-success" name="beli" value="Beli">
                </form>

              </div>
            </div>
          </div>
        </div>



    <?php 
    }
  }
    ?>

    </div>
</div>

<style type="text/css">
  .card-body{
    text-align: center;
  }
  .card-footer{
    text-align: center;
  }
  span{
    color:green;
    text-transform: uppercase;
  }
</style>


<?php
if (isset($_POST['keranjang'])){

  $id_user = $_SESSION['id'];
  $id_produk = $_POST['id'];
  $qty = $_POST['qty'];
  $harganya = $_POST['harga'];
  $total = $harganya * $qty;
  $keranjang = mysqli_query($konn,"insert into keranjang (id_keranjang,id_user,id_produk,qty,total) value ('NULL','$id_user','$id_produk','$qty','$total')")  or die(mysqli_error($konn));
}
?>

<?php
if (isset($_POST['beli'])){
   $id_user = $_SESSION['id'];
    $qty = $_POST['qty'];
    $id_barang = $_POST['id'];
    $tanggal = date("Y-m-d");
    $harganya = $_POST['harga'];
    $total = $harganya * $qty;
    if ($qty < 1){
        echo '<script>alert("Jumlah Tidaak Diperbolehkan");location.href="keranjang.php"</script>';
  
    }else{
        $beli = mysqli_query($konn,"insert into transaksi (tgl_transaksi,id_pelanggan,id_produk,qty,subtotal) values ('$tanggal','$id_user','$id_barang','$qty','$total')")or die(mysqli_error($konn));
      }
        if($beli){
            echo '<script>alert("Sukses Beli");location.href="index.php"</script>';
  
        }else{
          echo '<script>alert("Gagal Beli");location.href="index.php"</script>';
        }
    
    
}

?>

