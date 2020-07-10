<?php
	include_once("config.php");
	$month = $_GET['month'];
	$result = mysqli_query($mysqli, "SELECT DISTINCT tanggal_penjualan FROM penjualan where tanggal_penjualan like '%/".$month."/%'");
	$out = [];
	$i = 0;
	while ($data = mysqli_fetch_array($result)){
		$out[$i]=$data['tanggal_penjualan'];
		$i++;
	}
	echo json_encode($out);
?>