<?php

session_start();
include 'classadmin.php';
include 'classpemilih.php';
$adm = new Admin();
$pml = new Pemilih();
$username = $_SESSION['username'];

 if (!$adm->session()) {
    header("location:loginadmin.php");
  }

  if (isset($_GET['q'])) {
    $adm->logout();
    header("location:loginadmin.php");
  }

if (isset($_POST["submit"])) {
	//cek berhasil atau tidak
	if ($pml->tambah($_POST) > 0) {
		echo "<script>
		alert('Pemilih berhasil ditambah!');
		document.location.href = 'datapemilih.php';
		</script>";
	} else {
		echo "<script>
		alert('Pemilih gagal ditambah!');
		document.location.href = 'datapemilih.php';
		</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

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

<body style="background: #F0F1EC;">
	<div class="container mt-2">
		<?php
      		require('navbar_admin.php');
    	?>
		<div class="card mt-2 mb-2">
			<div class="card-body p-3">
				<h3 class="card-title">Tambah Pemilih</h3>
				<hr>
				<form action="" method="post">
					<div class="form-group mb-3">
						<label for="id_pemilih" class="text">ID Pemilih</label>
						<input type="text" class="form-control" name="id_pemilih" id="id_pemilih" required=""
							autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="password" class="text">Password</label>
						<input type="text" class="form-control" name="password" id="password" required=""
							autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="nama" class="text">Nama</label>
						<input type="text" class="form-control" name="nama" id="nama" required="" autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="status" class="text">Status</label>
						<select class="form-select" name="status" id="status">
							<option selected>Pilih Status...</option>
							<option value="Dosen">Dosen</option>
							<option value="Mahasiswa">Mahasiswa</option>
						</select>
					</div>
					<div class="form-group mb-3">
						<label for="jenis_kelamin" class="text">Jenis Kelamin</label>
						<select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
							<option selected>Pilih Jenis Kelamin...</option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="form-group mb-3">
						<label for="votestatus" class="text">Status Vote</label>
						<input type="text" class="form-control" name="votestatus" id="votestatus" value="Belum" readonly>
					</div>
					<div class="form-group mb-3">
						<label for="statusverify" class="text">Status Verifikasi</label>
						<input type="text" class="form-control" name="statusverify" id="statusverify" value="Belum" readonly>
					</div>
					<button type="submit" class="btn btn-outline-success" name="submit">Selesai</button>
					<button type="button" name="kembali" class="btn btn-outline-danger" onclick="history.back()">Kembali</button>
				</form>
			</div>
		</div>
		<?php
     		 require('footer.php');
    	?>
	</div>
</body>

</html>