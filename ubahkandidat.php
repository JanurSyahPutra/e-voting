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
  
$id_kandidat = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM kandidat WHERE id = $id_kandidat ");

$kandidat = mysqli_fetch_assoc($query);

if (isset($_POST["submit"])) {
	if ($kan->ubahkan($_POST) > 0) {
		echo "
		<script>
		alert('Calon Kandidat Berhasil Diedit!');
		document.location.href = 'datakandidat.php';
		</script>";
	} else {
		echo "
		<script>
		alert('Calon Kandidat Gagal Diedit!');
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
<h3>Ubah Data Kandidat</h3>

		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="gambarlama" id="gambarlama" value="<?= $kandidat["gambar"]; ?>">
		<input type="hidden" name="id" id="id" value="<?= $kandidat["id"]; ?>">

			
		<div class="form-group mb-3">
			<label for="id_kandidat" class="text" >Nomor Kandidat</label>
		<input type="text" class="form-control" name="id_kandidat" id="id_kandidat" required value="<?= $kandidat["id_kandidat"]; ?>">
		</div>
		<div class="form-group mb-3">
			<label for="gambar" class="text" >Foto kandidat</label>
			<input type="file" name="gambar" id="gambar">
			<p><img src="img/<?= $kandidat["gambar"]; ?>"></p>
			<!-- <input type="checkbox" name="ubah" value="true"> Beri Cek jika ingin mengubah gambar -->
		</div>
		<div class="form-group mb-3">
			<label for="namaketua" class="text" >Nama Ketua</label>
			<input type="text" class="form-control" name="namaketua" id="namaketua" required value="<?= $kandidat["namaketua"]; ?>">
		</div>
		<div class="form-group mb-3">
			<label for="namawakil" class="text" >Nama Wakil</label>
			<input type="text" class="form-control" name="namawakil" id="namawakil" required value="<?= $kandidat["namawakil"]; ?>">
		</div>
		<div class="form-group mb-3">
			<label for="visi" class="text" >Visi</label>
			<input type="text" class="form-control" name="visi" id="visi" required value="<?= $kandidat["visi"]; ?>">
		</div>
		<div class="form-group mb-3">
			<label for="misi" class="text" >Misi</label>
			<input type="text" class="form-control" name="misi" id="misi" required value="<?= $kandidat["misi"]; ?>">
		</div>
		<div class="form-group mb-3">
			<label for="misi" class="text" >Suara</label>
			<input type="text" class="form-control" name="jml" id="jml" required value="<?= $kandidat["jml"]; ?>" readonly>
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

