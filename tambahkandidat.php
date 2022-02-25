<?php

session_start();
include 'classadmin.php';
include 'classkandidat.php';
$adm = new Admin();
$kan = new Kandidat();
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
	if ($kan->tambahkan($_POST) > 0) {
		echo "<script>
		alert('Calon Kandidat Berhasil Ditambah!');
		document.location.href = 'datakandidat.php';
		</script>";
	} else {
		echo "<script>
		alert('Calon Kandidat Gagal Ditambah!');
		document.location.href = 'datakandidat.php';
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
				<h3 class="card-title">Tambah Calon Kandidat</h3>
				<hr>

				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<label for="id_kandidat" class="text">Nomor Kandidat</label>
						<input type="text" class="form-control" name="id_kandidat" id="id_kandidat" required=""
							autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="gambar" class="text">Foto kandidat</label>
						<input type="file" class="form-control-file" name="gambar" id="gambar">
					</div>
					<div class="form-group mb-3">
						<label for="namaketua" class="text">Nama Ketua</label>
						<input type="text" class="form-control" name="namaketua" id="namaketua" required=""
							autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="namawakil" class="text">Nama Wakil</label>
						<input type="text" class="form-control" name="namawakil" id="namawakil" required=""
							autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="visi" class="text">Visi</label>
						<input type="text" class="form-control" name="visi" id="visi" required="" autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="misi" class="text">Misi</label>
						<input type="text" class="form-control" name="misi" id="misi" required="" autocomplete="off">
					</div>
					<div class="form-group mb-3">
						<label for="jml" class="text">Suara</label>
						<input type="text" class="form-control" name="jml" id="jml" value="0" readonly>
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