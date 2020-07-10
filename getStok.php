<?php
	include_once("config.php");
	$kode = $_GET['kode'];
	$result = mysqli_query($mysqli, "SELECT stok FROM barang where kode_barang = '$kode'");
	$firstrow = mysqli_fetch_assoc($result);
	echo $firstrow['stok'];
?>