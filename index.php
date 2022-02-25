<?php
session_start();
include 'classpemilih.php';
$pml = new Pemilih();

if ($pml->session()) {
	header("location:pemilih.php");
}

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
</head>
<body>
	<div class="container w-25">
			<div class="mt-5 p-4 rounded" style="background-image: linear-gradient(to right, #79bd9a, #a8dba8);">
				<div class="form-contact">
							<img src="icon/logologin.png" width="300" class="img-fluid mx-auto">
							<h5 class="text-center text-light">Login Pemilih</h5>
						<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
						$login = $pml->login($_POST['id_pemilih'], $_POST['password']);
						if ($login) {
							header("location:pemilih.php");
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
			  <input type="text" class="form-control" name="id_pemilih" id="floatingInput" placeholder="ID Pemilih" required="">
			  <label for="floatingInput">ID Pemilih</label>
			</div>
			<div class="form-floating mb-3">
			  <input type="password" class="form-control" name="password" id="floatingInput" placeholder="Password" required="">
			  <label for="floatingInput">Password</label>
			</div>
			<!-- <div class="mb-2">
				<input type="text" name="id_pemilih" id="id_pemilih" class="form-control form-block" placeholder="ID Pemilih">
			</div>
			<div class="mb-2">
				<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			</div> -->
					<button type="submit" class="btn btn-outline-light" name="login">Login</button>
					<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#regis">Registrasi</button>
				<hr>
				<h5 class="text-center text-light">Anda Admin ? <a href="loginadmin.php" class="text-decoration-none text-light">Sini</a></h5>
		</form>
					</div>
				</div>
			</div>
			<!-- <div class="modal-footer">
				<button type="submit" class="btn btn-outline-dark btn-block" name="login">Login</button> 
				<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#regis">
					Registrasi
				</button>
			</div>
			<h5><a class="text1">Anda Admin? <a href="loginadmin.php" class="text1">Sini</a></a></h5>
	</form> -->
</div>

	<div class="modal fade" id="regis" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
      	<div class="modal-header">
      		<h3 class="modal-title">Registrasi Pemilih</h3>
        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      	</div>
      <div class="modal-body">
        <form action="regis.php" method="post">
			<div class="form-group mb-2">
				<label for="id_pemilih">ID Pemilih</label>
				<input type="text" class="form-control" name="id_pemilih" id="id_pemilih" autocomplete="off">
				<div id="passwordHelpBlock" class="form-text">
					  ID yang dimasukan harus Nim atau Nip
				</div>
			</div>
			<div class="form-group mb-2">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password">
				<div id="passwordHelpBlock" class="form-text">
					  Password minimal harus 6 karakter.
				</div>
			</div>
			<div class="form-group mb-2">
				<label for="nama">Nama Lengkap</label>
				<input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
			</div>
			<div class="form-group mb-2">
				<label for="status">Status</label>
				<select class="form-select" name="status" id="status">
					<option selected>Pilih Status...</option>
					<option value="Dosen">Dosen</option>
					<option value="Mahasiswa">Mahasiswa</option>
			</select>
			</div>
			<div class="form-group mb-3">
				<label for="jenis_kelamin">Jenis Kelamin</label>
				<select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
					<option selected>Pilih Jenis Kelamin...</option>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
			</select>
			</div>
			<input type="hidden" name="votestatus" value="Belum">
			<input type="hidden" name="statusverify" value="Belum">
			<div class="modal-footer">
			<div class="d-grid gap-2 col-6 mx-auto">
				<button type="submit" class="btn btn-outline-success btn-block" name="regis">Daftar</button>
			</div>
			</div>
	</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>