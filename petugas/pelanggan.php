<?php 

session_start();

if ($_SESSION['petugas']!=true) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title></title>
</head>
<body>
    
<div class="container col-11 py-5">
<div class="mb-3">
    
<form action="" method="post" class="form-inline py-3" style="float: right">
    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="<?php
    if(isset($_POST['cari'])){
      echo $_POST['search'];
    }
    ?>">
    <button name="cari" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>

<button type="button" class="btn btn-success py-3 col-md-3 mb-3" data-toggle="modal" data-target="#tambah">
Tambah Pelanggan
</button>
            <!-- Modal Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                Nama :

                <input type="text" name="nm_plggn" value="" class="form-control">

                Alamat :

                <input type="text" name="almt_plggn" value="" class="form-control">

                No Telp :

                <input type="text" name="telp_plggn" value="" class="form-control">

                Username :

                <input type="text" name="username" value="" class="form-control">

                Password :

                <input type="text" name="password" value="" class="form-control">
                
            </div>
            <div class="modal-footer">
                <input type="submit" name="simpan" value="Tambah Pelanggan" class="btn btn-success">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form> 
            </div>
            </div>
        </div>
        </div>

</div>
    <div class="row" id="load_data">
<?php
      include "../koneksi.php";
    if(isset($_POST['cari'])){
      $cari = $_POST['search'];
      $data = mysqli_query($konn,"select * from pelanggan where nama like '%".$cari."%' OR alamat like '%".$cari."%' OR username like '%".$cari."%'");				
    }else{
      $data = mysqli_query($konn,"select * from pelanggan");		
    }
    $no = 1;
    $row = mysqli_num_rows($data);
    if ($row < 1){
      ?>
      <div class="col-12 py-5">
      <center>
        <h1 style="color:red;">
          <b>
            Mohon Maaf, Pelanggan Yang Anda Cari Tidak Ditemukan
          </b>
        </h1>
      </center>
      </div>

      <?php
    }else{

      while($d = mysqli_fetch_array($data)){
        $id = $d["id_pelanggan"];
        $nama = $d["nama"];
        $alamat = $d["alamat"];
        $telp = $d["telp"];
        $username = $d["username"];
      ?>
    
    <div class="col-sm-3 mb-5">
        <div class="card" style="text-align: center" >
            <img src="https://cdn-icons-png.flaticon.com/512/3225/3225084.png" class="card-img-top" alt="gambar">
            <div class="card-body">
            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <h3 class="card-text">Username :<?php echo $username; ?></h3>
            <p class="card-title">Nama : <?php echo $nama; ?></p>
            <p class="card-text">Alamat :<?php echo $alamat; ?></p>
            <p class="card-text">Telp :<?php echo $telp; ?></p>
            </div>
            
            <div class="card-footer" style="align-content: center;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#id<?php echo$id?>">
                    Edit 
                </button>
                <input type="submit" name="hapus" value="Hapus" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">
            </div>
            </form>

        </div>
        </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="id<?php echo$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form action="" method="post">
                                                <input type="hidden" name="id_pelanggan" value="<?=$dt['id_pelanggan']; ?>">
                                                    Nama :

                                                    <input type="text" name="nm_plggn" value="<?php echo $nama?>" class="form-control">

                                                    Alamat :

                                                    <input type="text" name="almt_plggn" value="<?php echo $alamat?>" class="form-control">

                                                    No Telp :

                                                    <input type="text" name="telp_plggn" value="<?php echo $telp?>" class="form-control">

                                                    Username :

                                                    <input type="text" name="username" value="<?php echo $username?>" class="form-control">

                                                    Password :

                                                    <input type="text" name="password" value="" class="form-control">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" name="edit" value="Edit Pelanggan" class="btn btn-success">
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
</body>

</html>

<?php

                if(isset($_POST['simpan'])){

                    $nama=$_POST['nm_ptgs'];
                    $username=$_POST['username'];
                    $password=$_POST['password'];

                    if(empty($nama)){
                        echo "<script>alert('nama pelanggan tidak boleh kosong');location.href='petugas.php';</script>";
                    } elseif(empty($username)){

                        echo "<script>alert('alamat pelanggan tidak boleh kosong');location.href='petugas.php';</script>";
                    } elseif(empty($password)){

                        echo "<script>alert('password tidak boleh kosong');location.href='petugas.php';</script>";
                    } elseif(empty($level)){

                        echo "<script>alert('level tidak boleh kosong');location.href='petugas.php';</script>";
                    }   else {
                        include "koneksi.php";

                        $insert=mysqli_query($konn,"insert into petugas (nama_petugas, username, password, level) value ('".$nama."','".$username."','".md5($password)."','petugas')") or die(mysqli_error($konn));

                        if($insert){
                            echo "<script>alert('Sukses menambahkan Petugas');location.href='tampil_petugas.php';</script>";
                        } else {
                            echo "<script>alert('Gagal menambahkan Petugas');location.href='petugas.php';</script>";
                        }
                    }
                }
?>

<?php
if(isset($_POST['hapus'])){
    $id = $_POST['id'];
    $hps = mysqli_query($konn,"delete from pelanggan where id_pelanggan='$id'");
    if($hps){
        echo '<script>location.href="pelanggan.php"</script>';
    }else{

    }
}else

?>

<?php
if(isset($_POST['edit'])){
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama=$_POST['nm_plggn'];
    $almt=$_POST['almt_plggn'];
    $tlp=$_POST['telp_plggn'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    if(empty($nama)){
        echo "<script>alert('nama petugas tidak boleh kosong');location.href=' pelanggan.php';</script>";
    } elseif(empty($almt)){

        echo "<script>alert('alamat petugas tidak boleh kosong');location.href=' pelanggan.php';</script>";
    } elseif(empty($tlp)){

        echo "<script>alert('telpn petugas tidak boleh kosong');location.href='pelanggan.php';</script>";
    }   elseif(empty($username)){

        echo "<script>alert('username tidak boleh kosong');location.href='pelanggan.php';</script>";
    } elseif(empty($password)){
        include "koneksi.php";

        $update=mysqli_query($konn,"update pelanggan set 
        nama='$nama',alamat='$almt',telp='$tlp', username='$username' where id_pelanggan = '".$id_pelanggan."'") or die(mysqli_error($konn));

        if($update){
            echo "<script>alert('Sukses Edit Pelanggan');location.href='pelanggan.php';</script>";
        } else {
            echo "<script>alert('Gagal Edit Pelanggan');location.href='pelanggan.php?id_pelanggan=".$id_pelanggan."';</script>";
        }

    }else {
        include "koneksi.php";

        $update=mysqli_query($konn,"update pelanggan set 
        nama='$nama',alamat='$almt',telp='$tlp', username='$username', password='".md5($password)."' where id_pelanggan = '".$id_pelanggan."'") or die(mysqli_error($konn));

        if($update){
            echo "<script>alert('Sukses Edit Pelanggan');location.href='pelanggan.php';</script>";
        } else {
            echo "<script>alert('Gagal Edit Pelanggan');location.href='pelanggan.php';</script>";
        }
    }
}
?>
