<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php 
    

    session_start();
    
    if ($_SESSION['admin']!=true) {
        header("Location:../");
    
    }else{
        include "../koneksi.php";
        $sql = mysqli_query($konn,"select * from transaksi");
        $cek = mysqli_num_rows($sql);
    }

    include "navbar.php";
?>

<div class="container col-11 py-5">
        <?php
        if($cek == 0){
            ?>
            <center>
                <h1 style="color:red">
                    <b>
                        Pesanan Kosong Nih '(
                    </b>
                </h1>
            </center>
            <?php
        }else{
            ?>
            <h2 class="mb-3">Data Pesanan</h2>
            <table class="table table-hover striped">
            <thead>

            <tr>
    
                <th>NO</th>
                <th>Foto Barang</th>
                <th>Nama pemesan</th>
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
                    <td><?php
                    $id_pelanggan = $history['id_pelanggan']; 
                    $sql3 = mysqli_query($konn,"select * from pelanggan where id_pelanggan = '$id_pelanggan'");
                    $pelanggan = mysqli_fetch_array($sql3);
                    echo $pelanggan['nama']
                    ?>
                
                    </td>
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
                                    Pesanan Sedang Dikonfirmasi
                                </div>
                            <?php
                        }else if($status == "dikonfirmasi"){
                            ?>
                                <div class="alert alert-dark" role="alert">
                                    Pesanan Sedang Dikonfirmasi
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
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $history['id_transaksi']?>">
                                    <input type="submit" class="btn btn-success" style="width:150px" name="konfirmasi" value="Konfirmasi">
                                </form>
                            <?php
                        }else if($status == "dikonfirmasi"){
                            ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $history['id_transaksi']?>">
                                    <input type="submit" class="btn btn-success"  style="width:150px" name="kirim" value="Kirim">
                                </form>
                            <?php
                        }else if($status == "dikirim"){
                            ?>  

                            <?php
                        }else if ($status == "diterima"){
                            ?>

                            <?php
                        }else{
                            ?>
                            <button type="button" class="btn btn-success" data-toggle="modal"  style="width:150px" data-target="#ulas <?php
                                echo $history['id_transaksi']
                                ?>">
                                    Lihat Ulasan
                                </button>
                            <?php
                        }
                        ?>
                        
                    </form>
                </tr>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="ulas <?php echo $history['id_transaksi']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ulasan <?=$pelanggan['nama']?></h5>
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
                                    <input type="text" value="<?php echo $history['ulasan']?>"  class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        header("Location:../");
        }
        
?>


<?php
if(isset($_POST['konfirmasi'])){
    $id = $_POST['id'];
    $konfirm = mysqli_query($konn,"update transaksi set status='dikonfirmasi' where id_transaksi ='$id'");
    if ($konfirm){
        echo '<script>location.href="pesanan.php"</script>';
    }
}

?>

<?php
if(isset($_POST['kirim'])){
    $id = $_POST['id'];
    $konfirm = mysqli_query($konn,"update transaksi set status='dikirim' where id_transaksi ='$id'");
    if ($konfirm){
        echo '<script>location.href="pesanan.php"</script>';
    }
}

?>

<?php 
include "../footer.php";
?> 