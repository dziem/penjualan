<?php
include_once("config.php");

$kode = $_GET['kode'];

$result = mysqli_query($mysqli, "DELETE FROM barang WHERE kode_barang=$kode");

header("Location: barang.php");
?>