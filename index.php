<?php
	include_once("config.php");

	$result = mysqli_query($mysqli, "SELECT * FROM penjualan order by id_penjualan desc limit 10");
	$rowcount = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Dashboard Penjualan</title>
	</head>
	
	<body>
		<div class="container-fluid">
			<div class="row">
				<aside class="col-3">
					<div class="row text-center">
						<a class="active col-12">Home</a>
						<a href="penjualan.php" class="col-12">Penjualan</a>
						<a href="barang.php" class="col-12">Barang</a>
					</div>
				</aside>
				<main class="col-9">
					<?php 
						if ($rowcount == 0){
							echo "<h3>Tidak ada penjualan</h3>";
						}else{
					?>
					<div class="row">
						<div class="col-6">
							<h4>Total pendapatan bulan ini</h4>
							<canvas id="bar-chart" width="400" height="400"></canvas>
						</div>
						<div class="col-6">
							<h4>Total pendapatan per kategori</h4>
							<canvas id="pie-chart" width="400" height="400"></canvas>
						</div>
						<div class="col-12">
							<h4>10 penjualan terakhir</h4>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama Konsumen</th>
										<th scope="col">Tanggal Penjualan</th>
										<th scope="col">Total Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php  
									$i = 1;
									while($data = mysqli_fetch_array($result)) {         
										echo "<tr>";
										echo "<td>".$i."</td>";
										echo "<td>".$data['nama_konsumen']."</td>";
										echo "<td>".$data['tanggal_penjualan']."</td>";
										$total = 0;
										$result2 = mysqli_query($mysqli, "SELECT harga_total FROM detail_penjualan where id_penjualan = ".$data['id_penjualan']);
										while($data2 = mysqli_fetch_array($result2)) {
											$total = $total + $data2['harga_total'];
										}
										echo "<td>".$total."</td>";   
										$i++;
									}
									?>
								</tbody>
							</table>
						</div>
						<?php 
							}
						?>
					</div>
				</main>
			</div>
		</div>
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script>
			var d = new Date();
			var n = ("0" + (d.getMonth() + 1)).slice(-2);
			var tanggal;
			$.ajax({
				url : "http://localhost/penjualan/getDate.php?month="+n,
				type : "get",
				async: false,
				success : function(data) {
					var res = JSON.parse(data);
					tanggal = res;
				}
			});
			var total;
			$.ajax({
				url : "http://localhost/penjualan/getTotal.php?month="+n,
				type : "get",
				async: false,
				success : function(data) {
					var res = JSON.parse(data);
					total = res;
				}
			});
			var bar = document.getElementById('bar-chart');
			var myChart = new Chart(bar, {
				type: 'bar',
				data: {
					labels: tanggal,
					datasets: [{
						label: 'total pendapatan',
						data: total,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						]
					}]
				}
			});
			var kategori;
			$.ajax({
				url : "http://localhost/penjualan/getKategori.php",
				type : "get",
				async: false,
				success : function(data) {
					var res = JSON.parse(data);
					kategori = res;
				}
			});
			var totalKategori;
			$.ajax({
				url : "http://localhost/penjualan/getTotalKategori.php",
				type : "get",
				async: false,
				success : function(data) {
					var res = JSON.parse(data);
					totalKategori = res;
				}
			});
			var pie = document.getElementById('pie-chart');
			var myChart = new Chart(pie, {
				type: 'pie',
				data: {
					labels: kategori,
					datasets: [{
						data: totalKategori,
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						]
					}],
				}
			});
		</script>
	</body>
</html>