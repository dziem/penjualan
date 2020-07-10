<?php
	include_once("config.php");
	$month = $_GET['month'];
	$result = mysqli_query($mysqli, "SELECT DISTINCT tanggal_penjualan FROM penjualan where tanggal_penjualan like '%/".$month."/%'");
	$out = [];
	$i = 0;
	while($data = mysqli_fetch_array($result)) {
		$result2 = mysqli_query($mysqli, "select id_penjualan from penjualan where tanggal_penjualan = '".$data['tanggal_penjualan']."'");
		while($data2 = mysqli_fetch_array($result2)) {
			$total = 0;
			$result3 = mysqli_query($mysqli, "SELECT harga_total FROM detail_penjualan where id_penjualan = ".$data2['id_penjualan']);
			while($data3 = mysqli_fetch_array($result3)) {
				$total = $total + $data3['harga_total'];
			}
		}
		$out[$i] = $total;
		$i++;
	}
	echo json_encode($out);
?>