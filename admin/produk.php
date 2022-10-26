
<?php 

session_start();

if ($_SESSION['admin']!=true) {
    header("Location:../");

}
?>
<?php 
include "navbar.php"; 

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="container col-11 py-5">

  <div class="mb-3">

  <form action="" method="post" class="form-inline py-3" style="float: right">
    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="<?php
    if(isset($_POST['cari'])){
      echo $_POST['search'];
    }
    ?>">
    <!-- Button trigger modal -->

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
        $arr_gender=array('Makanan'=>'Makanan','Minuman'=>'Minuman','Chiki'=>'Chiki','Buah'=>'Buah');
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
                    <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#edit<?php echo$id?>">Edit</button>
                    <input type="submit" name="hapus" class="btn btn-danger" value="Hapus">
                    </form>
                  </div>
              </div>
            </div>

            <!-- Modal Edit -->
    <div class="modal fade" id="edit<?php echo$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                  <input type="hidden" name="id" value="<?php echo $id?>">

                Nama :

                <input type="text" name="nm_produk" value="<?php echo $nama?>" class="form-control" placeholder="Nama Produk" required>

                Kategori :

                <select name="kategori" class = "form-control" required >
                    <option value="<?php echo $kategori?>"><?php echo $kategori?></option>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                    <option value="chiki">Chiki</option>
                    <option value="buah">Buah</option>
                </select>

                Harga :

                <input type="number" name="harga" value="<?php echo $harga?>" class="form-control" required placeholder="Harga">

                
            </div>
            <div class="modal-footer">
                <input type="submit" name="edit" value="Edit" class="btn btn-warning text-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
                <?php
if (isset($_POST['edit'])){
  echo 'asasas';
  $id = $_POST['id'];
  $nama=$_POST['nm_produk'];
    $kategori=$_POST['kategori'];
    $harga=$_POST['harga'];
  $edit = mysqli_query($konn,"update produk set nam_produk='$nama',kategori='$kategori',harga='$harga' where id_produk='$id'") or die(mysqli_error($konn));
  if ($edit){
    echo "<script>location.href='produk.php';</script>";
  }
}

?>
            </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

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
                <input type="submit" name="simpan" value="Tambah Produk" class="btn btn-success">
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

<?php
if(isset($_POST['simpan'])) {
    $nama=$_POST['nm_produk'];
    $kategori=$_POST['kategori'];
    $harga=$_POST['harga'];
    $foto = basename($_FILES["foto"]["name"]);
    $target_dir = "../gambar/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(empty($nama)){
        echo "<script>alert('nama produk tidak boleh kosong');location.href='produk.php';</script>";
    } elseif(empty($kategori)){
        echo "<script>alert('deskripsi produk tidak boleh kosong');location.href='produk.php';</script>";
    } elseif(empty($harga)){
        echo "<script>alert('harga produk tidak boleh kosong');location.href='produk.php';</script>"; 
    } elseif(empty($foto)){
        echo "<script>alert('foto produk tidak boleh kosong');location.href='produk.php';</script>"; 
    } else {
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check == false) {
            echo "<script>alert('File yang dipilih bukan foto.');location.href='produk.php';</script>";
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
        }
        echo "asdasd";
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('File foto sudah ada.');location.href='produk.php';</script>";
        $uploadOk = 0;
        }

        echo "asdasd";
        // Check file size
        if ($_FILES["foto"]["size"] > 500000) {
            echo "<script>alert('File foto terlalu besar');location.href='produk.php';</script>";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script>alert('Hanya menerima file foto JPG, JPEG, PNG & GIF');location.href='produk.php';</script>";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('File foto tidak terupload');location.href='produk.php';</script>";  
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                
                include "../koneksi.php";
                
                $insert=mysqli_query($konn,"insert into produk (nam_produk,kategori,harga,foto_produk) values ('$nama','$kategori','$harga','$foto')") or die(mysqli_error($konn));

                if($insert) {
                    echo "<script>alert('Sukses menambahkan produk');location.href='produk.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan produk');location.href='produk.php';</script>";
                }
            } else {
                echo "<script>alert('Error saat upload file foto');location.href='produk.php';</script>";
            }
        }

    }
}
?>

<?php
if (isset($_POST['hapus'])){
  $id = $_POST['id'];
  $hps = mysqli_query($konn,"delete from produk where id_produk='$id'");
  if ($hps){
    echo "<script>location.href='produk.php';</script>";
  }
}

?>



<?php
if (isset($_POST['edit'])){
  $id = $_POST['id'];
    $nama=$_POST['nm_produk'];
    $kategori=$_POST['kategori'];
    $harga=$_POST['harga'];

    if(empty($nama)){
        echo "<script>alert('nama produk tidak boleh kosong');location.href='produk.php';</script>";
    } elseif(empty($kategori)){
        echo "<script>alert('deskripsi produk tidak boleh kosong');location.href='produk.php';</script>";
    } elseif(empty($harga)){
        echo "<script>alert('harga produk tidak boleh kosong');location.href='produk.php';</script>"; 
    } else {
      $update=mysqli_query($konn,"update produk set nam_produk='$nama',kategori='$kategori',harga='$harga' where id_produk='$id'") or die(mysqli_error($konn));

                if($update) {
                    echo "<script>alert('Sukses update produk');location.href='produk.php';</script>";
                } else {
                    echo "<script>alert('Gagal update produk');location.href='produk.php';</script>";
                }
    }
}

?>