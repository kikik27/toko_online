
<?php 

session_start();

if ($_SESSION['petugas']!=true) {
    header("Location:../");

}
?>
<?php 
include "navbar.php"; 

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

    <button type="button" class="btn btn-success py-3 col-sm-3 mb-3" data-toggle="modal" data-target="#tambah">Tambah Produk</button>

  </div>


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
                    <input type="submit" name="edit" class="btn btn-warning text-light" value="Edit">
                    <input type="submit" name="hapus" class="btn btn-danger" value="Hapus">
                  </div>
              </div>
            </div>


    <?php 
    }
    }
    ?>

    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                Nama :

                <input type="text" name="nm_produk" value="" class="form-control" placeholder="Nama Produk" required>

                Kategori :

                <select name="kategori" class = "form-control" required >
                    <option value="">Pilih Kategori</option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                    <option value="chiki">Chiki</option>
                    <option value="buah">Buah</option>
                </select>

                Harga :

                <input type="number" name="harga" value="" class="form-control" required placeholder="Harga">

                Foto :

                <input type="file" name="foto" id="fileToUpload"  class="form-control mb-3">

                
            </div>
            <div class="modal-footer">
                <input type="submit" name="simpan" value="Tambah Petugas" class="btn btn-success">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form> 
            </div>
            </div>
        </div>
        </div>

<style type="text/css">
  .card-body{
    text-align: center;
  }
  .card-footer{
    text-align: center;
  }
</style>
<?php include "../footer.php"; ?>

