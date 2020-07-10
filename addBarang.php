<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Tambah Barang</title>
	</head>
	
	<body>
		<div class="container add-page">
			<a href="barang.php" class="btn btn-secondary">Go back</a>
			<h3>Tambah barang baru</h3>
			<form action="addBarang.php" method="post" name="form1">
				<div class="form-group">
					<label for="nama-barang">Nama barang</label>
					<input type="text" class="form-control" id="nama-barang" name="nama-barang" placeholder="Nama barang">
				</div>
				<div class="form-group">
					<label for="kategori-barang">Kategori barang</label>
					<select class="form-control" id="kategori-barang" name="kategori-barang">
						<option selected disabled>Kategori barang</option>
						<option value="Hardware">Hardware</option>
						<option value="Software">Software</option>
						<option value="Accessories">Accessories</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="harga-beli-barang">Harga beli barang</label>
					<input type="number" min="0" class="form-control" id="harga-beli-barang" name="harga-beli-barang" placeholder="Harga beli barang">
				</div>
				<div class="form-group">
					<label for="harga-jual-barang">Harga jual barang</label>
					<input type="number" min="0" class="form-control" id="harga-jual-barang" name="harga-jual-barang" placeholder="Harga jual barang">
				</div>
				<div class="form-group">
					<label for="stok-barang">Stok barang saat ini</label>
					<input type="number" min="0" class="form-control" id="stok-barang" name="stok-barang" placeholder="Stok barang saat ini">
				</div>
				<input type="submit" class="btn btn-primary" name="submit" value="Tambah">
			</form>
		</div>

		<?php
		if(isset($_POST['submit'])) {
			$nama = $_POST['nama-barang'];
			$kategori = $_POST['kategori-barang'];
			$hargaBeli = $_POST['harga-beli-barang'];
			$hargaJual = $_POST['harga-jual-barang'];
			$stok = $_POST['stok-barang'];
			
			include_once("config.php");

			$result = mysqli_query($mysqli, "INSERT INTO barang(nama_barang,harga_jual,harga_beli,stok,kategori) VALUES('$nama','$hargaJual','$hargaBeli','$stok','$kategori')");

			header('Location: barang.php');
		}
		?>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>