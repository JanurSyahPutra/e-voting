<?php

session_start();
include 'classpemilih.php';
$pml = new Pemilih();
// $id_kandidat = $_GET["id_kandidat"];

if (!$pml->session()) {
    header("location:index.php");
  }

  if (isset($_GET['q'])) {
    $pml->logout();
    header("location:index.php");
  }

$id_kandidat = $_GET["id_kandidat"];

$sql = "SELECT * FROM kandidat WHERE id_kandidat = '$id_kandidat' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$jml = $row["jml"] + 1;
$sql = "UPDATE kandidat SET jml = '$jml' WHERE id_kandidat = '$id_kandidat'";
mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
  echo "<script>
		alert('Terima Kasih Sudah Memilih!')
		document.location.href = 'pemilih.php';
		</script>";
}


$id_pemilih = $_SESSION["id_pemilih"];
$sql2 = "UPDATE pemilih SET votestatus = 'Sudah' WHERE id_pemilih = '$id_pemilih'";
mysqli_query($conn, $sql2);

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
<body style="background: #F0F1EC;">
  <nav class="navbar navbar-expand-lg" style="background-color: #a8dba8; ">
  <a class="navbar-brand" style="color: #2b2b2b;"><img src="icon/logotit.png" width="30" height="30" class="d-inline-block align-top" alt="">
  EV
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="pemilih.php" style="color: #2b2b2b;"><img src="icon/home.png" width="20" class="d-inline-block align-top"> Beranda</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="calonkandidat.php" style="color: #2b2b2b;"><img src="icon/vote.png" width="20" class="d-inline-block align-top"> Perolehan Suara</a>
    </li>
    </ul>
  </div>
  <a href="?q=logout" class="btn btn-outline-dark"><img src="icon/logout.png" width="20" class="d-inline-block align-top"> Logout</a>
</nav>
<div class="container">
	<h2 class="text1" style="text-align: center;
	">Terimakasih Sudah Berpatisipasi</h3>

	<h2 class="text1">Perolehan Suara Sementara</h2>
	<!-- Menghitung Presentase Suara -->
	<?php
	$result = mysqli_query($conn, "SELECT * FROM kandidat");
	foreach ($result as $row): ?>
		<?php
		$total = 0;
		$result2 = mysqli_query($conn, "SELECT * FROM kandidat");
		foreach ($result2 as $row2) {
			$total = $total + $row2["jml"];
		}

		$persen = 0;
		if ($total != 0) {
			$persen = ($row["jml"]/$total) * 100;
		}
		?>
		<label for="namaketua" class="text1" >Calon Kandidat <?= $row["nokandidat"] ?></label>
		<p><?= $row["namaketua"] ?> - <?= $row["namawakil"] ?></p>
		<div class="progress">
		<div class="progress-bar" style="background:  #79bd9a; width: <?php echo $persen; echo "%";?>"><?php echo $persen; echo "%";?></div>
		</div>
		<?php


	?>
	<?php endforeach; ?>
  <p></p>
  <a href="pemilih.php" class="btn btn-outline-dark"><img src="icon/next.png" width="20" class="d-inline-block align-top"> Lanjut...</a>
</div>
</body>
</html>