<?php
	include_once("config.php");

	$result = mysqli_query($mysqli, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Input Penjualan</title>
	</head>
	
	<body>
		<div class="container-fluid">
			<div class="row">
				<aside class="col-3">
					<div class="row text-center">
						<a href="index.php" class="col-12">Home</a>
						<a class="active col-12">Penjualan</a>
						<a href="barang.php" class="col-12">Barang</a>
					</div>
				</aside>
				<main class="col-9">
					<h3>Input Penjualan</h3>
					<form action="penjualan.php" method="post" name="form1">
						<div class="form-group">
							<label for="nama-pembeli">Nama pembeli</label>
							<input type="text" class="form-control" id="nama-pembeli" name="nama-pembeli" placeholder="Nama pembeli">
						</div>
						<div class="form-group">
							<label for="alamat-pembeli">Alamat pembeli</label>
							<textarea class="form-control" id="alamat-pembeli" name="alamat-pembeli" rows="3"></textarea>
						</div>
						<button type="button" class="btn btn-primary" onclick="cloneItem()">Tambah barang</button>
						<div id="items">
							
						</div>
						<input type="submit" class="btn btn-primary" name="submit" id="btn-inp" value="Input">
					</form>
				</main>
			</div>
		</div>
		<?php
		if(isset($_POST['submit'])) {
			$nama = $_POST['nama-pembeli'];
			$alamat = $_POST['alamat-pembeli'];
			$tanggal = date("d/m/Y");
			
			include_once("config.php");
			echo "INSERT INTO penjualan(nama_konsumen,alamat,tanggal_penjualan) VALUES('$nama','$alamat',STR_TO_DATE($tanggal, '%d/%m/%Y'))";
			$result = mysqli_query($mysqli, "INSERT INTO penjualan(nama_konsumen,alamat,tanggal_penjualan) VALUES('$nama','$alamat','$tanggal')");
			if ($result){
				$last_id = mysqli_insert_id($mysqli);
			} else {
				mysqli_error($mysqli);
			}
			$i = 0;
			foreach ($_POST['nama-barang'] as $input_nama_barang) {
				$nama_barang_array[$i] = $input_nama_barang;
				$i++;
			}
			$i = 0;
			foreach ($_POST['jumlah'] as $input_jumlah) {
				$jumlah_array[$i] = $input_jumlah;
				$i++;
			}
			for($j = 0;$j < $i;$j++){
				$kode = $nama_barang_array[$j];
				$result = mysqli_query($mysqli, "SELECT harga_jual,stok FROM barang where kode_barang = '$kode'");
				$firstrow = mysqli_fetch_assoc($result);
				$harga = $firstrow['harga_jual'];
				$stok_asal = $firstrow['stok'];
				$jumlah = $jumlah_array[$j];
				$stok_baru = $stok_asal - $jumlah;
				$result = mysqli_query($mysqli, "UPDATE barang SET stok='$stok_baru' WHERE kode_barang=$kode");
				$harga_total = $jumlah * $harga;
				$result = mysqli_query($mysqli, "INSERT INTO detail_penjualan(id_penjualan,kode_barang,jumlah,harga_satuan,harga_total) VALUES('$last_id','$kode','$jumlah','$harga','$harga_total')");
			}
			header('Location: index.php');
		}
		?>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script>
			var aidi = 1;
			function cloneItem(){
				$("#btn-inp").show();
				var newaidi = "item-"+aidi;
				var barangaidi = "nama-barang-"+aidi;
				var jumlahaidi = "jumlah-"+aidi;
				var item = `<div class="clone-item" id=${newaidi}>
								<div class="form-group">
									<label for="nama-barang">Nama barang</label>
									<select class="form-control" onchange="updateMax(${aidi})" id="${barangaidi}" name="nama-barang[]">
										<option selected disabled>Nama barang</option>`;
										<?php
											while($data = mysqli_fetch_array($result)) {
										?>
				item +=	"<option value='<?= $data['kode_barang'] ?>'><?= $data['nama_barang'] ?></option>";
										<?php	
											};
										?>
				item +=					`</select>
								</div>`;
				item += `<div class="form-group">
							<label for="jumlah">Jumlah</label>
							<input type="number" class="form-control" id="${jumlahaidi}" class="jumlah" name="jumlah[]" placeholder="Jumlah barang">
							</div>
						</div>`;
				aidi += 1;
				$( "#items" ).append( item );
			}
			function updateMax(aidiitem){
				var kode = $('#nama-barang-'+aidiitem).val();
				$.get( "http://localhost/penjualan/getStok.php?kode="+kode, function( data ) {
					$('#jumlah-'+aidiitem).attr("max",data);
				});
			}
		</script>
	</body>
</html>