<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container col-11">
            <a class="navbar-brand" href="index.php">PT. DEVARO SEJAHTERA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <a class="nav-link" href="pelanggan.php">pelanggan
            </a>
            <a class="nav-link" href="petugas.php">Petugas
            </a>
            <a class="nav-link" href="produk.php">Produk
            </a>
            <a class="nav-link" href="pesanan.php">Pesanan
            </a>
            <a class="nav-link" href="laporan.php">Laporan
            </a>
            </ul>
            <form action="" method="post">
        <span class="navbar-text">
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