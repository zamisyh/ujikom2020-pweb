<?php 
	
	session_start();
	include "../config.php";
	if(!isset($_SESSION['loginAdmin']) === true){
		header("Location: ../");
	}

	if(isset($_POST['guruEdit']) === true){
		$idGuru = htmlspecialchars($_POST['idGuru']);
		$namaGuru = htmlspecialchars($_POST['nama_guru']);
        $namaMapel = htmlspecialchars($_POST['nama_mapel']);
		$alamat = htmlspecialchars($_POST['alamat']);
		
		$editQueryGuru = mysqli_query($conn, "UPDATE guru SET nama_guru = '$namaGuru', alamat = '$alamat', 
		nama_mapel = '$namaMapel' WHERE id = '$idGuru'");

		if(mysqli_affected_rows($conn) > 0){
			$success = true;
		}else{
			$error = true;
		}
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
</head>
<body>
	
	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-6">
				<a href="create/guru.php" class="btn btn-primary">Tambah Data Guru</a>
				<a href="logout.php" class="btn btn-danger">Logout</a>
				<br><br>
				<p>
					<?php if (isset($success)): ?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							Data berhasil di update
						</div>
						<?php endif ?>

						<?php if (isset($error)): ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								Errors
							</div>
					<?php endif ?>
				</p>
				<table class="table table-bordered table-striped table-responsive" id="dataGuru">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Guru</th>
							<th>Alamat</th>
							<th>Nama Mapel</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							$dataGuru = mysqli_query($conn, "SELECT * FROM guru ORDER BY id DESC");
							while($rowGuru = mysqli_fetch_array($dataGuru)){

							
						?>
						
						  <tr>
							 <td><?= $no; ?></td>
							 <td><?= $rowGuru['nama_guru']; ?></td>
							 <td><?= $rowGuru['alamat']; ?></td>
							 <td><?= $rowGuru['nama_mapel']; ?></td>
							 <td class="d-flex">
								 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editGuru<?= $rowGuru['id'] ?>"
                    			 id="#editGuru<?= $rowGuru['id'] ?>">Edit</button>
								 <a onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $rowGuru['nama_guru'] ?>')" href="delete/guru.php?id=<?= $rowGuru['id'] ?>" class="btn btn-danger btn-sm ml-1">Delete</a>
							 </td>
						  </tr>

						<?php $no++; ?>

						<div class="modal fade" id="editGuru<?= $rowGuru['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editGuru<?= $rowGuru['id'] ?>Label"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="editGuru<?= $rowGuru['id'] ?>Label">Data - <?= $rowGuru['nama_guru'] ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<div class="form-group">
											<label for="nama_guru">Nama Guru</label>
											<input type="text" name="nama_guru" id="nama_guru" class="form-control" value="<?= $rowGuru['nama_guru'] ?>" >
										</div>
										<div class="form-group">
											<label for="nama_mapel">Nama Mapel</label>
											<input type="text" name="nama_mapel" id="nama_mapel" class="form-control" value="<?= $rowGuru['nama_mapel'] ?>" >
										</div>

										<div class="form-group">
											<label for="alamat">Alamat</label>
											<textarea name="alamat" id="alamat" rows="5" class="form-control"><?= $rowGuru['alamat'] ?></textarea>
										</div>
										<input type="hidden" name="idGuru" value="<?= $rowGuru['id'] ?>">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="guruEdit" class="btn btn-primary">Save changes</button>
								</div>
								</form>
							</div>
							</div>
						</div>

						<?php }?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-6">
			<a href="create/siswa.php" class="btn btn-primary">Tambah Data Siswa</a>
			<a href="create/nilai.php" class="btn btn-success">Tambah Nilai Siswa</a>
			<br><br>
		        <p></p>
				<table class="table table-bordered table-striped table-responsive" id="dataSiswa">
					<thead>
						<tr>
							<th>No</th>
							<th>Nis</th>
							<th>Nama Siswa</th>
							<th>TTL</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							$dataSiswa = mysqli_query($conn, "SELECT * FROM siswa INNER JOIN nilai ON siswa.nis = nilai.nis");
							while($rowSiswa = mysqli_fetch_array($dataSiswa)){

							
						?>
						
						  <tr>
							 <td><?= $no; ?></td>
							 <td><?= $rowSiswa['nis']; ?></td>
							 <td><?= $rowSiswa['nama_siswa']; ?></td>
							 <td><?= $rowSiswa['tempat_lahir']; ?>, <?= date('d M Y', strtotime($rowSiswa['tanggal_lahir'])) ?></td>
							 <td class="d-flex">
							 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataSiswa<?= $rowSiswa['nis'] ?>"
								 id="#dataSiswa<?= $rowSiswa['nis'] ?>">Detail</button>
							<button type="button" class="btn btn-primary btn-sm ml-1" data-toggle="modal" data-target="#dataNilai<?= $rowSiswa['nis'] ?>"
                    			 id="#dataNilai<?= $rowSiswa['nis'] ?>">Nilai</button>
							 <a onclick="return confirm('Apakah anda yakin ingin menghapus data <?= $rowSiswa['nama_siswa'] ?>')" href="delete/siswa.php?nis=<?= $rowSiswa['nis'] ?>" class="btn btn-danger btn-sm ml-1">Delete</a>
							 </td>
						  </tr>

						<?php $no++; ?>


						<div class="modal fade" id="dataSiswa<?= $rowSiswa['nis'] ?>" tabindex="-1" role="dialog" aria-labelledby="dataSiswa<?= $rowSiswa['nis'] ?>Label"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="dataSiswa<?= $rowSiswa['nis'] ?>Label">Data - <?= $rowSiswa['nama_siswa'] ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="" method="post">
									
									<div class="form-group">
										<label for="nis">NIS</label>
										<input type="number" name="nis" id="nis" class="form-control" value="<?= $rowSiswa['nis'] ?>">
									</div>
									<div class="form-group">
										<label for="username">Username</label>
										<input type="text" name="username" id="username" class="form-control" value="<?= $rowSiswa['username'] ?>">
									</div>
									<div class="form-group">
										<label for="nama_siswa">Nama Siswa</label>
										<input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= $rowSiswa['nama_siswa'] ?>">
									</div>
									<div class="form-group">
										<label for="jenis_kelamin">Jenis Kelamin</label>
										<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
										<?php if ($rowSiswa['jk'] === "L"): ?>
											<option value="<?= $rowSiswa['jk'] ?>">Laki-laki</option>
										<?php endif ?>
										<?php if ($rowSiswa['jk'] === "P"): ?>
											<option value="<?= $rowSiswa['jk'] ?>">Perempuan</option>
										<?php endif ?>
											<option disabled>--------------</option>
											<option value="L">Laki-laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label for="tempat_lahir">Tempat Lahir</label>
										<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $rowSiswa['tempat_lahir'] ?>">
									</div>
									<div class="form-group">
										<label for="tanggal_lahir">Tanggal Lahir</label>
										<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $rowSiswa['tanggal_lahir'] ?>">
									</div>
									<div class="form-group">
										<label for="jurusan">Jurusan</label>
										<select name="jurusan" id="jurusan" class="form-control">
											<option value="<?= $rowSiswa['jurusan'] ?>"><?= $rowSiswa['jurusan'] ?></option>
											<option disabled>--------------</option>
											<option value="RPL">RPL</option>
											<option value="TEI">TEI</option>
											<option value="PB">PB</option>
											<option value="KA">KA</option>
										</select>
									</div>
									<div class="form-group">
										<label for="email">email</label>
										<input type="text" name="email" id="email" class="form-control" value="<?= $rowSiswa['email'] ?>">
									</div>
									<div class="form-group">
										<label for="hp">No HP</label>
										<input type="number" name="hp" id="hp" class="form-control" value="<?= $rowSiswa['hp'] ?>">
									</div>
									<div class="form-group">
										<label for="alamat">Alamat</label>
										<textarea name="alamat" id="alamat" rows="5" class="form-control"><?= $rowSiswa['alamat'] ?></textarea>
									</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									
								</div>
								</form>
							</div>
							</div>
						</div>

						<div class="modal fade" id="dataNilai<?= $rowSiswa['nis'] ?>" tabindex="-1" role="dialog" aria-labelledby="dataNilai<?= $rowSiswa['nis'] ?>Label"
							aria-hidden="true">
							<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="dataNilai<?= $rowSiswa['nis'] ?>Label">Data Nilai - <?= $rowSiswa['nama_siswa'] ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="" method="post">
									<div class="form-group">
										<label for="indonesia">Indonesia</label>
										<input type="number" class="form-control" name="indonesia" id="indonesia" value="<?= $rowSiswa['indonesia'] ?>">
									</div>
									<div class="form-group">
										<label for="inggris">Inggris</label>
										<input type="number" class="form-control" name="inggris" id="inggris" value="<?= $rowSiswa['inggris'] ?>">
									</div>
									<div class="form-group">
										<label for="mtk">MTK</label>
										<input type="number" class="form-control" name="mtk" id="mtk" value="<?= $rowSiswa['mtk'] ?>">
									</div>
									<div class="form-group">
										<label for="kejuruan">Kejuruan</label>
										<input type="number" class="form-control" name="kejuruan" id="kejuruan" value="<?= $rowSiswa['kejuruan'] ?>">
									</div>
									<div class="form-group">
										<label for="kejuruan">Rata-Rata</label>
										<input type="number" class="form-control" name="kejuruan" id="kejuruan" value="<?= $rowSiswa['rata_rata'] ?>">
									</div>
									
              
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									
								</div>
								</form>
							</div>
							</div>
						</div>

						<?php }?>
					</tbody>
				</table>
			</div>
		</div>

		<p>
			
		</p>
	</div>

	<script src="../assets/plugins/jquery/jquery-v3.2.1.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>
	<script src="../assets/plugins/jquery-datatable/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/jquery-datatable/dataTables.bootstrap4.min.js"></script>

	<script>
		$(document).ready(function() {
			$('#dataGuru').DataTable();
		});

		$(document).ready(function() {
			$('#dataSiswa').DataTable();
		});
	</script>

</body>
</html>