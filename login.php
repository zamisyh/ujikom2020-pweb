<?php 

	session_start();

	include 'config.php';

	if (isset($_SESSION['loginAdmin'])) {
		header("Location: admin/");
	}

	if(isset($_SESSION['loginUsers'])){
		header("Location: siswa/");
	}

	if(isset($_POST['login']) === true) {
		$username = htmlspecialchars($_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		$check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

		if(mysqli_num_rows($check) === 1){
			$row = mysqli_fetch_array($check);
			if(password_verify($password, $row['password'])){
				if($row['level'] === 'admin'){
					$_SESSION['level'] = $row['level'];
					$_SESSION['username'] = $row['username']; 
					$_SESSION['loginAdmin'] = true;

					header("Location: admin/");

				}else{
					$_SESSION['level'] = $row['level'];
					$_SESSION['username'] = $row['username']; 
					$_SESSION['nama'] = $row['nama'];
					$_SESSION['loginUsers'] = true;

					header("Location: siswa/");
				}
			}else{
				echo "<script>alert('Error Password!')</script>";
			}
		}else{
			echo "<script>alert('Error Name!')</script>";
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
 						<h5 class="title">Sign in to yout account</h5>
						<div class="form-group">

								
						
						</div>
 						<div class="form-group form-float">
 							<div class="form-line">
 								<input type="text" name="username" class="form-control" required>
 								<label class="form-label">Username</label>
 							</div>
 						</div>
 						<div class="form-group form-float">
 							<div class="form-line">
 								<input type="password" name="password" class="form-control" required>
 								<label class="form-label">Password</label>
 							</div>
 						</div>
 						<div class="col-lg-12">
 							<button type="submit" value="Login" name="login" class="btn btn-raised btn-primary waves-effect">SIGN IN</button>
 							<a href="register.php" class="btn btn-raised btn-default waves-effect">SIGN UP</a>
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