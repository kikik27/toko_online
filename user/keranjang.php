<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php 
    

    session_start();
    
    if ($_SESSION['user']!=true) {
        header("Location:../");
    
    }else{
        include "../koneksi.php";
        $id_user = $_SESSION['id'];
        $sql = mysqli_query($konn,"select * from keranjang where id_user = '$id_user'");
        $cek = mysqli_num_rows($sql);
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

<div class="container col-11 py-5">
        <?php
        if($cek == 0){
            ?>
            <center>
                <h1 style="color:red">
                    <b>
                        Keranjang Kosong Nih '(
                    </b>
                </h1>
            </center>
            <?php
        }else{
            ?>
            <h2 class="mb-3">Keranjang</h2>
            <table class="table table-hover striped">
            <thead>

            <tr>
    
                <th>NO</th>
                <th>Foto Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th></th>
    
            </tr>
    
        </thead>
    
        <tbody>
            <?php
            $no = 0;
            while ($keranjang = mysqli_fetch_array($sql))
            {   $id_produk = $keranjang['id_produk'];
                $sql2 = mysqli_query($konn,"select * from produk where id_produk = '$id_produk'")  or die(mysqli_error($konn));
                $produk = mysqli_fetch_array($sql2);

            $no++;
            ?>

                <tr>    

                    <td><?php echo $no?></td>
                    <td><img src="../gambar/<?php echo$produk['foto_produk']?>" width="10%" alt=""></td>
                    <td><?=$produk['nam_produk']?></td>
                    <td><?=$produk['harga']?></td>

                    <form action="" method="post">
                    <input type="hidden" name="id_keranjang" value="<?=$keranjang['id_keranjang']?>">
                    <input type="hidden" name="id" value="<?php echo $produk['id_produk']?>">
                    <input type="hidden" name="harga" value="<?=$produk['harga']?>">
                    <td><input type="number" name="qty" value="<?=$keranjang['qty']?>"id=""></td>
                    <td><?=$keranjang['total']?></td>

                    <td>

                        <input type="submit" name="beli" class="btn btn-success" value="Beli">

                        <input type="submit" name="hapus" class="btn btn-danger" value="Hapus">
                        </form>
                    </td>

    
                </tr>

                    
                        
                    
            <?php

        }
    }
        ?>
                </tbody>

</table>
</div>




<?php 
        
        if(isset($_POST['logout'])){
        session_destroy();
        header("Location:../");
        }
        
?>

<?php
if(isset($_POST['hapus'])){
    $id = $_POST['id'];
    $hapus = mysqli_query($konn,"delete from keranjang where id_keranjang='$id'");
    if ($hapus){
        echo '<script>location.href="index.php"</script>';
    }
}

?>

<?php
if (isset($_POST['beli'])){
    $id_keranjang = $_POST['id_keranjang'];
   $id_user = $_SESSION['id'];
    $qty = $_POST['qty'];
    $id_barang = $_POST['id'];
    $tanggal = date("Y-m-d");
    $harganya = $_POST['harga'];
    $total = $harganya * $qty;
    echo $tanggal;
    if ($qty < 1){
        echo '<script>alert("Jumlah Tidaak Diperbolehkan");location.href="keranjang.php"</script>';
  
    }else{
        $beli = mysqli_query($konn,"insert into transaksi (tgl_transaksi,id_pelanggan,id_produk,qty,subtotal) values ('$tanggal','$id_user','$id_barang','$qty','$total')")or die(mysqli_error($konn));
      }
        if($beli){
            $hps = mysqli_query($konn,"delete from keranjang where id_keranjang = '$id_keranjang'");
            if($hps){
                echo '<script>alert("Sukses Beli");location.href="index.php"</script>';
            }
        }
    
    
}

?>


<?php 
include "../footer.php";
?>