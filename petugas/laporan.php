<?php 
	require '../koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
?>
<style>
	.judul{
		text-align: center;
	}
</style>
<html>
	<head>
		<title>LAPORAN WEB transaksi SUKA OLENG</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
						<div class="judul py-5 text-success">
						<h1>LAPORAN PENJUALAN PT. DEVARO SEJAHTERA</h1>
						<h5>Tanggal : <?php  echo date("j F Y, G:i");?></h5>
						</div>
                        
					<table class="table table-bordered" style="width:100%;text-align:center;">
					<thead class="thead-dark">
						<tr>
							<td>NO</td>
							<td>FOTO</td>
							<td>NAMA BARANG</td>
							<td>TANGGAL SOLD</td>
							<td>NAMA PEMBELI</td>
                            <td>ULASAN</td>
							<td>HARGA</td>
                            <td>JUMLAH</td>
                            <td>TOTAL</td>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$sql = mysqli_query($konn, "select * from transaksi where status ='selesai'");
						while ($transaksi = mysqli_fetch_array($sql)){
						$id_barang = $transaksi['id_produk'];
						$id_user = $transaksi['id_pelanggan'];
						$sql2 = mysqli_query($konn, "select * from produk where id_produk ='$id_barang'");
						$barang = mysqli_fetch_array($sql2);
						$sql3 = mysqli_query($konn, "select * from pelanggan where id_pelanggan = '$id_user'");
						$user = mysqli_fetch_array($sql3);	
						?>
						
						<tr>
							<td><?php echo $no;?></td>
							<td><img src="../gambar/<?php echo $barang['foto_produk']?>"height="100px"alt=""></td>
							<td><?php echo $barang['nam_produk'];?></td>
							<td><?php echo $transaksi['tgl_transaksi'];?></td>
							<td><?php echo $user['nama'];?></td>
                            <td><?php echo $transaksi['ulasan'];?></td>
							<td><?php echo $barang['harga'];?></td>
                            <td><?php echo $transaksi['qty'];?></td>
                            <td><?php echo $transaksi['subtotal'];?></td>
						</tr>
					</tbody>
						<?php $no++; }?>
					</table>
					<div class="clearfix"></div>
					<center>
                    <br>
						<h5 class="text-warning">Laporan Penjualan PT. Devaro Sejahtera</h5>
					</center>
				</div>
			</div>
		</div>
	</body>
    
</html>
