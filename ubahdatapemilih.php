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
  
// ambil data
$id_pemilih = $_GET["id_pemilih"];

// membuat variabel $query
$query = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_pemilih = '$id_pemilih'");

// query data pemilih
$pem = mysqli_fetch_assoc($query);

if (isset($_POST["submit"])) {
	if ($pml->ubah($_POST) > 0) {
		echo "
		<script>
		alert('Data Pemilih Berhasil Diedit!');
		document.location.href = 'datapemilih.php';
		</script>";
	} else {
		echo "<script>
		alert('Data Pemilih Gagal Diedit!');
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
	<link rel="stylesheet" href="mystyle.css">
</head>
<body style="background: #F0F1EC;">
<div class="container mt-2">
<?php
require('navbar_admin.php');
?>
<div class="card mt-2 mb-2">
<div class="card-body p-3">
<h3 class="card-title">Edit Data Pemilih</h3>
<hr>
	<form action="" method="post">
		<div class="form-group mb-3">
		<label for="id_pemilih" class="text">ID Pemilih</label>
		<input type="text" class="form-control" name="id_pemilih" id="id_pemilih" required value="<?= $pem["id_pemilih"] ?>">
		</div>
		<div class="form-group mb-3">
			<label for="password" class="text">Password</label>
			<input type="text" class="form-control" name="password" id="password" required value="<?= $pem["password"] ?>">
		</div>
		<div class="form-group mb-3">
			<label for="nama" class="text">Nama Lengkap</label>
			<input type="text" class="form-control" name="nama" id="nama" required value="<?= $pem["nama"] ?>">
		</div>
		<div class="form-group mb-3">
			<label for="status" class="text">Status</label>
				<select class="form-select" name="status" id="status">
					<option selected>Pilih Status...</option>
					<option value="Dosen" <?php if ($pem["status"] == "Dosen") {
						echo "selected"; }
						?> >Dosen</option>
					<option value="Mahasiswa" <?php if ($pem["status"] == "Mahasiswa") {
						echo "selected"; }
						?> >Mahasiswa</option>
			</select>
		</div>
		<div class="form-group mb-3">
			<label for="jenis_kelamin" class="text">Jenis Kelamin</label>
			<select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
					<option selected>Pilih Jenis Kelamin...</option>
					<option value="Laki-Laki" <?php if ($pem["jenis_kelamin"] == "Laki-Laki") {
						echo "selected"; } ?> >Laki-Laki</option>
					<option value="Perempuan" <?php if ($pem["jenis_kelamin"] == "Perempuan") {
						echo "selected"; } ?> >Perempuan</option>
			</select>
		</div>
		<div class="form-group mb-3">
			<label for="votestatus" class="text">Status Vote</label>
			<input type="text" class="form-control" name="votestatus" id="votestatus" required value="<?= $pem["votestatus"] ?>" readonly>
		</div>
		<div class="form-group mb-3">
			<label for="statusverify" class="text">Status Verifikasi</label>
			<input type="text" class="form-control" name="statusverify" id="statusverify" required value="<?= $pem["statusverify"] ?>" readonly>
		</div>
			<button type="submit" class="btn btn-outline-success btn-block" name="submit">Selesai</button>
			<button type="button" name="kembali" class="btn btn-outline-danger" onclick="history.back()">Kembali</button>
	</form>
</div>
</div>
</div>
<?php
require('footer.php');
?>
</body>
</html>