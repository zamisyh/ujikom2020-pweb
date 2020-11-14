<?php 
	
	session_start();

	include '../config.php';

	if(!isset($_SESSION['loginUsers']) === true){
		header("Location: ../");
	}

	$name = $_SESSION['nama'];
	$selectData = mysqli_query($conn, "SELECT * FROM siswa INNER JOIN nilai ON siswa.nis = nilai.nis WHERE nama_siswa = '$name'");
	$data = mysqli_fetch_array($selectData);


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang</title>
	<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
</head>
<body>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-8">
				<h4>Data <?= $_SESSION['nama'] ?></h4>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>Level</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= $_SESSION['username'] ?></td>
							<td><?= $_SESSION['nama'] ?></td>
							<td><?= $_SESSION['level'] ?></td>
						</tr>
					</tbody>
				</table>

				<p>
					<a href="logout.php" class="btn btn-primary">Logout</a>
				</p>

			</div>

			<div class="col-lg-4">
				<h4>Data Nila <?= $_SESSION['nama'] ?></h4>
				<div class="card card-body">
					<div class="form-group p-3">
						B. Indonesia = <?= $data['indonesia'] ?><br>
						B. Inggris = <?= $data['inggris'] ?><br>
						Matematika = <?= $data['mtk'] ?><br>
						Kejuruan = <?= $data['kejuruan'] ?><br>
						<hr>
						<p>Rata-Rata = <?= $data['rata_rata'] ?> </p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="../assets/plugins/jquery/jquery-v3.2.1.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="../assets/plugins/jquery-datatable/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.js"></script>
</body>
</html>