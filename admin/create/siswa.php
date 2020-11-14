<?php

session_start();
include "../../config.php";
if(!isset($_SESSION['loginAdmin']) === true){
    header("Location: ../");
}

    if(isset($_POST['submitBtn']) === true){
        $nis = htmlspecialchars($_POST['nis']);
        $username = htmlspecialchars($_POST['username']);
        $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
        $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
        $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
        $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
        $jurusan = htmlspecialchars($_POST['jurusan']);
        $email = htmlspecialchars($_POST['email']);
        $hp = htmlspecialchars($_POST['hp']);
        $alamat = htmlspecialchars($_POST['alamat']);


        $querySave = mysqli_query($conn, "INSERT INTO siswa VALUES ('$nis', '$username', '$nama_siswa', '$jenis_kelamin', 
        '$tempat_lahir', '$tanggal_lahir', '$jurusan', '$alamat', '$email', '$hp')");
        
        if(mysqli_affected_rows($conn) > 0){
            $success = true;
            echo '<meta http-equiv="refresh" content="2; url=../index.php">';
        }else{
           $error = true;
         
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <form action="" method="post">
            <div class="form-group">
            <?php if (isset($success)): ?>
                <div class="alert alert-success">Data berhasil di tambahkan</div>
            <?php endif ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger">Error <?= mysqli_error($conn); ?></div>
            <?php endif ?>
            </div>
            <div class="form-group">
		        <label for="nis">NIS</label>
				<input type="number" name="nis" id="nis" class="form-control">
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="nama_siswa">Nama Siswa</label>
			    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control">
		    </div>
			<div class="form-group">
				<label for="jenis_kelamin">Jenis Kelamin</label>
				<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
					<option value="">Pilih</option>
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
			</div>
			<div class="form-group">
			    <label for="tempat_lahir">Tempat Lahir</label>
			    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
			</div>
			<div class="form-group">
			    <label for="tanggal_lahir">Tanggal Lahir</label>
				<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
			</div>
			<div class="form-group">
				<label for="jurusan">Jurusan</label>
				<select name="jurusan" id="jurusan" class="form-control">
					<option value="">Pilih</option>
					<option value="RPL">RPL</option>
                    <option value="TEI">TEI</option>
                    <option value="PB">PB</option>
					<option value="KA">KA</option>
				</select>
			</div>
			<div class="form-group">
				<label for="email">email</label>
				<input type="text" name="email" id="email" class="form-control">
		    </div>
			<div class="form-group">
				<label for="hp">No HP</label>
				<input type="number" name="hp" id="hp" class="form-control">
		    </div>
			<div class="form-group">
				<label for="alamat">Alamat</label>
				<textarea name="alamat" id="alamat" rows="5" class="form-control"></textarea>
			</div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="submitBtn">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>