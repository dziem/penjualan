<?php
include_once("config.php");

if(isset($_POST['update']))
{   
    $kode = $_POST['kode_barang'];

    $nama = $_POST['nama-barang'];
	$kategori = $_POST['kategori-barang'];
	$hargaBeli = $_POST['harga-beli-barang'];
	$hargaJual = $_POST['harga-jual-barang'];
	$stok = $_POST['stok-barang'];

    $result = mysqli_query($mysqli, "UPDATE barang SET nama_barang='$nama',harga_jual='$hargaJual',harga_beli='$hargaBeli',kategori='$kategori',stok='$stok' WHERE kode_barang=$kode");

    header("Location: barang.php");
}
?>
<?php
$kode = $_GET['kode'];

$result = mysqli_query($mysqli, "SELECT * FROM barang WHERE kode_barang=$kode");

while($data = mysqli_fetch_array($result))
{
    $nama = $data['nama_barang'];
	$kategori = $data['kategori'];
	$hargaBeli = $data['harga_beli'];
	$hargaJual = $data['harga_jual'];
	$stok = $data['stok'];
}
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Ubah data <?= $nama ?></title>
	</head>
	
	<body>
		<div class="container add-page">
			<a href="barang.php" class="btn btn-secondary">Go back</a>
			<h3>Ubah data <?= $nama ?></h3>
			<form action="editBarang.php" method="post" name="form1">
				<input type="hidden" name="kode_barang" value=<?= $kode?>>
				<div class="form-group">
					<label for="nama-barang">Nama barang</label>
					<input type="text" class="form-control" id="nama-barang" name="nama-barang" value="<?= $nama ?>" placeholder="Nama barang">
				</div>
				<div class="form-group">
					<label for="kategori-barang">Kategori barang</label>
					<select class="form-control" id="kategori-barang" name="kategori-barang">
						<option disabled>Kategori barang</option>
						<option value="Hardware">Hardware</option>
						<option value="Software">Software</option>
						<option value="Accessories">Accessories</option>
						<option value="Other">Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="harga-beli-barang">Harga beli barang</label>
					<input type="number" min="0" class="form-control" id="harga-beli-barang" value="<?= $hargaBeli ?>" name="harga-beli-barang" placeholder="Harga beli barang">
				</div>
				<div class="form-group">
					<label for="harga-jual-barang">Harga jual barang</label>
					<input type="number" min="0" class="form-control" id="harga-jual-barang" value="<?= $hargaJual ?>" name="harga-jual-barang" placeholder="Harga jual barang">
				</div>
				<div class="form-group">
					<label for="stok-barang">Stok barang saat ini</label>
					<input type="number" min="0" class="form-control" id="stok-barang" value="<?= $stok ?>" name="stok-barang" placeholder="Stok barang saat ini">
				</div>
				<input type="submit" class="btn btn-primary" name="update" value="Ubah">
			</form>
		</div>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script>
			$('#kategori-barang').val('<?= $kategori ?>'); 
			$('#kategori-barang').change();
		</script>
	</body>
</html>