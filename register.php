<?php 

	session_start();

	include 'config.php';

	if (isset($_SESSION['loginAdmin'])) {
		header("Location: admin/");
	}

	if(isset($_SESSION['loginUsers'])){
		header("Location: siswa/");
	}

	if(isset($_POST['submitBtn']) === true) {
        $username = htmlspecialchars($_POST['username']);
        $nama = htmlspecialchars($_POST['nama']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $newPass = password_hash($password, PASSWORD_DEFAULT);
        $level = "siswa";
        
        $save = mysqli_query($conn, "INSERT INTO users (username, password, nama, level) VALUES ('$username', '$newPass', '$nama', '$level')");
        
        if(mysqli_affected_rows($conn) > 0){
            $success = true;
            echo '<meta http-equiv="refresh" content="2; url=login.php">';
        }else{
            $error = true;
        }
	
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
 	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 	<meta name="description" content="">
 	<title>:: Semangka5 Programmer::</title>
 	<link rel="icon" href="favicon.ico" type="image/x-icon">

 	<!--Custom Css -->
 	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
 	<link rel="stylesheet" href="assets/css/main.css">
 	<link rel="stylesheet" href="assets/css/authentication.css">
 	<link rel="stylesheet" href="assets/css/color_skins.css">
 </head>
 <body class="theme-orange">
 	<div class="authentication">
 		<div class="card">
 			<div class="body">
 				<div class="row">
 					<div class="col-lg-12">
 						
 						<form action="" method="post">
 						<h5 class="title">Create Account</h5>
                         <div class="form-group">
                            <?php if (isset($success)): ?>
                                <div class="alert alert-success">Data berhasil di tambahkan</div>
                            <?php endif ?>

                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger">Error <?= mysqli_error($conn); ?></div>
                            <?php endif ?>
                         </div>
 						<div class="form-group form-float">
 							<div class="form-line">
 								<input type="text" name="username" class="form-control" required>
 								<label class="form-label">Username</label>
 							</div>
                         </div>
                         <div class="form-group form-float">
 							<div class="form-line">
 								<input type="text" name="nama" class="form-control" required>
 								<label class="form-label">Nama Lengkap</label>
 							</div>
 						</div>
 						<div class="form-group form-float">
 							<div class="form-line">
 								<input type="password" name="password" class="form-control" required>
 								<label class="form-label">Password</label>
 							</div>
 						</div>
 						<div class="col-lg-12">
 							<button type="submit" value="register" name="submitBtn" class="btn btn-raised btn-primary waves-effect">SUBMIT</button>
 							<a href="login.php" class="btn btn-raised btn-default waves-effect">SIGN IN</a>
 						</div>
 					</form>
 					</div>
 					<div class="col-lg-12 m-t-20">
                     Created by <a href="https://github.com/zamisyh">Zamzam</a>
					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 	<!--Jquery Core Js -->
 	<script src="assets/bundles/libscripts.bundle.js"></script>    
 	<script src="assets/bundles/vendorscripts.bundle.js"></script>
 	<script src="assets/bundles/mainscripts.bundle.js"></script>
 </body>
 </html>