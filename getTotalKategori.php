<?php
	include_once("config.php");
	$result = mysqli_query($mysqli, "SELECT DISTINCT kategori FROM barang");
	$kat = [];
	$out = [];
	$i = 0;
	while ($data = mysqli_fetch_array($result)){
		$kat[$i] = $data['kategori'];
		$out[$i] = 0;
		$i++;
	}
	$result = mysqli_query($mysqli, "SELECT * FROM detail_penjualan");
	while($data = mysqli_fetch_array($result)) {
		$result2 = mysqli_query($mysqli, "select kategori from barang where kode_barang = '".$data['kode_barang']."'");
		while($data2 = mysqli_fetch_array($result2)) {
			for ($z = 0;$z < $i;$z++){
				if ($data2['kategori'] == $kat[$z]){
					$out[$z] = $out[$z] + $data['harga_total'];
				}
			}
		}
	}
	echo json_encode($out);
?>