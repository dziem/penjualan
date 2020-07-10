<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM barang");
$rowcount = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Barang</title>
	</head>
	
	<body>
		<div class="container-fluid">
			<div class="row">
				<aside class="col-3">
					<div class="row text-center">
						<a href="index.php" class="col-12">Home</a>
						<a href="penjualan.php" class="col-12">Penjualan</a>
						<a class="active col-12">Barang</a>
					</div>
				</aside>
				<main class="col-9">
					<a href="addBarang.php" class="add-btn btn btn-primary btn-lg">Tambah barang</a>
					<?php 
						if ($rowcount == 0){
							echo "<h3>Tidak ada barang</h3>";
						}else{
					?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Nama Barang</th>
								<th scope="col">Kategori</th>
								<th scope="col">Harga Beli</th>
								<th scope="col">Harga Jual</th>
								<th scope="col">Stok</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php  
							$i = 1;
							while($data = mysqli_fetch_array($result)) {         
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$data['nama_barang']."</td>";
								echo "<td>".$data['kategori']."</td>";
								echo "<td>".$data['harga_beli']."</td>";    
								echo "<td>".$data['harga_jual']."</td>";    
								echo "<td>".$data['stok']."</td>";    
								echo "<td><a class='btn btn-sm btn-warning' href='editBarang.php?kode=$data[kode_barang]'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp<a class='btn btn-sm btn-danger' href='deleteBarang.php?kode=$data[kode_barang]'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";     
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php 
						}
					?>
				</main>
			</div>
		</div>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>