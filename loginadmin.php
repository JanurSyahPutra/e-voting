<?php
session_start();
include 'classadmin.php';
$adm = new Admin();

if ($adm->session()) {
	header("location:admin.php");
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	$login = $obj->loginadmin($_POST['username'], $_POST['password']);
// 	if ($login) {
// 		header("location:admin.php");
// 	}else{
// 		echo "Login Failed!";
// 	}
// }

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<link rel="icon" type="image/png" href="icon/logotit.png">
	<title>EV| E-Voting</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body background="bg.jpg"> <!-- style="background: #F0F1EC;" -->

	<div class="container w-25">
			<div class="mt-5 p-4 rounded" style="background-image: linear-gradient(to right, #79bd9a, #a8dba8);">
				<div class="form-contact">
						<img src="icon/logologin.png" width="300" class="img-fluid mx-auto">
						<h5 class="text-center text-light">Login Admin</h5>
						<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$login = $adm->loginad($_POST['username'], $_POST['password']);
						if ($login) {
							header("location:admin.php");
						}else{
						?><div class="alert alert-danger alert-dismissible">
					    	<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					    	<strong>Gagal!</strong> Cek Apakah ID/Password Anda Benar
					  	</div>
						<?php
						}
						}
						?>
		<hr>
		<form action="" method="post" >
			<div class="form-floating mb-2">
			  <input type="text" class="form-control" name="username" id="floatingInput" placeholder="ID Pemilih" required="">
			  <label for="floatingInput">Username</label>
			</div>
			<div class="form-floating mb-3">
			  <input type="password" class="form-control" name="password" id="floatingInput" placeholder="Password" required="">
			  <label for="floatingInput">Password</label>
			</div>
			<!-- <div class="form-group row">
				<label for="id_pemilih" class="sr-only">Username</label>
			<div class="col-sm-10">
				<input type="text" name="id_pemilih" id="id_pemilih" class="form-control form-block" placeholder="Username">
			</div>
			</div>
			<div class="form-group row">
				<label for="password" class="sr-only">Password</label>
			<div class="col-sm-10">
				<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			</div>
			</div> -->
			<div class="d-grid gap-2 col-6 mx-auto">
				<button type="submit" class="btn btn-outline-light" name="login">Login</button> 
			</div>
				<hr>
				<h5 class="text-center text-light">Bukan Admin ?<a href="index.php" class="text-decoration-none text-light"> Sini</a></a></h5>
		</form>
					</div>
				</div>
			</div>
		<p></p>

<!-- <div class="container2">
	<div class="modal-header" style="padding: 5px 70px;">
	<h2 style="font-family: serif;"><img src="icon/user2.png" width="35" class="d-inline-block align-top"> Admin</h2>
</div>
</p>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$login = $adm->loginad($_POST['username'], $_POST['password']);
	if ($login) {
		header("location:admin.php");
	}else{
		?><div class="alert alert-danger alert-dismissible">
    	<button type="button" class="close" data-dismiss="alert">×</button>
    	<strong>Gagal!</strong> Cek Apakah ID/Password Anda Benar
  	</div>
	<?php
	}
}

?>
<form action="" method="post">

			<div>
				<label for="username" class="text1">Username :</label>
				<input type="text" class="form-control" name="username" id="username">
			</div>
			<div>
				<label for="password" class="text1">Password :</label>
				<p><input type="password" class="form-control" name="password" id="password">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-outline-dark btn-block" name="login">Login</button>
			</div>
			<h5><a class="text1">Anda Nyasar? <a href="index.php" class="text1">Sini</a></a></h5>
	</form>
	</div> -->
<!-- <body>
	<form action="" method="POST" name="login">
	<table>
	<tr>
		<th>Username</th>
		<td> : </td>
		<td>
			<input type="text" name="username" autocomplete="off">
		</td>
	</tr>
	<tr>
		<th>Password</th>
		<td> : </td>
		<td>
			<input type="password" name="password">
		</td>
	</tr>
	<tr>
		<th></th>
		<td></td>
		<td>
			<input type="submit" name="login">
			<a href="loginpemilih.php">ANDA PEMILIH?</a>
		</td>
	</tr>
</form> -->

</table>
</body>
</html>
