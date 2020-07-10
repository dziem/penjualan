<?php
	include_once("config.php");
	$result = mysqli_query($mysqli, "SELECT DISTINCT kategori FROM barang");
	$out = [];
	$i = 0;
	while ($data = mysqli_fetch_array($result)){
		$out[$i]=$data['kategori'];
		$i++;
	}
	echo json_encode($out);
?>