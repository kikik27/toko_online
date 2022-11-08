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
        $sql = mysqli_query($konn,"select * from transaksi where id_pelanggan = '$id_user'");
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
                        history Kosong Nih '(
                    </b>
                </h1>
            </center>
            <?php
        }else{
            ?>
            <h2 class="mb-3">History</h2>
            <table class="table table-hover striped my-5">
            <thead>

            <tr>
    
                <th>NO</th>
                <th>Foto Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                <th></th>
    
            </tr>
    
        </thead>
    
        <tbody>
            <?php
            $no = 0;
            while ($history = mysqli_fetch_array($sql))
            {   $id_produk = $history['id_produk'];
                $sql2 = mysqli_query($konn,"select * from produk where id_produk = '$id_produk'")  or die(mysqli_error($konn));
                $produk = mysqli_fetch_array($sql2);

            $no++;
            ?>

                <tr>    

                    <td><?php echo $no?></td>
                    <td><img src="../gambar/<?php echo$produk['foto_produk']?>" width="10%" alt=""></td>
                    <td><?=$produk['nam_produk']?></td>
                    <td><?=$produk['harga']?></td>

                    <td><?=$history['qty']?></td>
                    <td><?=$history['subtotal']?></td>

                    <td>
                        <?php
                        $status = $history['status'];
                        if ($status == "diproses"){
                            ?>
                                <div class="alert alert-dark" role="alert">
                                    Pesanan Sedang Diproses
                                </div>
                            <?php
                        }else if($status == "dikonfirmasi"){
                            ?>
                                <div class="alert alert-dark" role="alert">
                                    Pesanan Dikonfirmasi
                                </div>
                            <?php
                        }else if($status == "dikirim"){
                            ?>
                                <div class="alert alert-dark" role="alert">
                                    Pesanan Sedang Dikirim
                                </div>
                            <?php
                        }else if ($status == "diterima"){
                            ?>
                                <div class="alert alert-dark" role="alert">
                                    Pesanan Telah Diterima  
                                </div>
                            <?php
                        }else{
                            ?>
                            <div class="alert alert-dark" role="alert">
                                Pesanan Selesai  
                            </div>
                        <?php
                        }
                        ?>
                        
                    </td>

                        
                        
                    <td>
                    <?php
                        $status = $history['status'];
                        if ($status == "diproses"){
                            ?>
                                
                            <?php
                        }else if($status == "dikonfirmasi"){
                            ?>
                            
                            <?php
                        }else if($status == "dikonfirmasi"){
                            ?>
                            
                            <?php
                        }else if($status == "dikirim"){
                            ?>  
                            <form action="" method="post">
                                <input type="hidden" name="id_history" value="<?=$history['id_transaksi']?>">
                                <input type="submit" name="diterima" class="btn btn-Success" style="width:150px" value="Diterima">
                            </form>
                            <?php
                        }else if ($status == "diterima"){
                            ?>
                            <form action="" method="post">
                                <button type="button" class="btn btn-success" data-toggle="modal" style="width:150px" data-target="#ulas <?php
                                echo $history['id_transaksi']
                                ?>">
                                    Ulas
                                </button>
                            </form>
                            <?php
                        }else{
                            
                        }
                        ?>
                        
                    </form>
                </tr>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="ulas <?php echo $history['id_transaksi']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ulas <?=$produk['nam_produk']?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_history" value="<?=$history['id_transaksi']?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="../gambar/<?php echo $produk['foto_produk']?>" class="card-img-top">
                                </div>

                                <div class="col-md-8">
                                    <center><p>Ulasan Anda</p></center>
                                    <textarea name="ulasan" id="" cols="35" rows="3"  class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="ulas" class="btn btn-Success" value="Ulas">
                    </form>
                        </div>
                        </div>
                    </div>
                    </div>
                    </td>
                    
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
        echo '<script>location.href="../"</script>';
        }
        
?>

<?php
if(isset($_POST['diterima'])){
    $id_history = $_POST['id_history'];
    echo $id_history;
    $diterima = mysqli_query($konn,"UPDATE `transaksi` SET `status` = 'diterima' WHERE `transaksi`.`id_transaksi` = '$id_history
    '") or die(mysqli_error($konn));
    if ($diterima){
        echo '<script>location.href="history.php"</script>';
    }
}elseif(isset($_POST['ulas'])){
    $id_history = $_POST['id_history'];
    $ulasan = $_POST['ulasan'];
    $ulas = mysqli_query($konn,"update transaksi set ulasan ='$ulasan' where id_transaksi ='$id_history'");
    if ($ulas){
        $diulas = mysqli_query($konn,"update transaksi set status='selesai' where id_transaksi ='$id_history'");
        if ($diulas){
            echo '<script>location.href="history.php"</script>';
        }
    }
}

?>

<?php 
include "../footer.php";
?> 