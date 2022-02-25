<?php

session_start();
include 'classkandidat.php';
include 'classadmin.php';
$adm = new Admin();
$username = $_SESSION['username'];

 if (!$adm->session()) {
    header("location:loginadmin.php");
  }

  if (isset($_GET['q'])) {
    $adm->logout();
    header("location:loginadmin.php");
  }

$conn = mysqli_connect("localhost","root", "", "e_voting");

// ambil
$result = mysqli_query($conn, "SELECT * FROM kandidat");
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
				<div class="table-title">
					<div class="row">
						<div class="col">
							<h2 class="text-success">Data Kandidat</h2>
						</div>
						<div class="col">
							<h4 class="text-end"><a href="tambahkandidat.php" class="btn btn-outline-success">Tambah Data Kandidat</a></h4>
						</div>
					</div>
				</div>
				<div class="table-responsive">
				<table class="table border-dark">
					<thead class="thead bg-success">
						<tr>
  							<th class="text-center text-light">#</th>
							<th class="text-center text-light">Nomor Kandidat</th>
							<th class="text-center text-light">Foto Kandidat</th>
							<th class="text-center text-light">Nama Ketua</th>
							<th class="text-center text-light">Nama Wakil</th>
							<th class="text-center text-light">Suara</th>
							<th class="text-center text-light">Aksi</th>
						</tr>
					</thead>

					<?php 
					$i = 1;
					foreach ($result as $row): ?>

					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						<td class="text-center"><?= $row["id_kandidat"]; ?></td>
						<td class="text-center"><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
						<td class="text-center"><?= $row["namaketua"]; ?></td>
						<td class="text-center"><?= $row["namawakil"]; ?></td>
						<td class="text-center"><?= $row["jml"]; ?></td>
						<td class="text-center">
							<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
							<button type="button" class="btn btn-info"><a class="text-decoration-none text-light" href="ubahkandidat.php?id=<?= $row["id"]; ?>">Edit</a></button>
							<button type="button" class="btn btn-danger"><a class="text-decoration-none text-light" href="hapuskandidat.php?id=<?= $row["id"]; ?>"
								onclick="return confirm('Anda Yakin Ingin Mengahpus Data Ini?');">Hapus</a></button>
							<!-- </div>
							<a href="ubahkandidat.php?id_kandidat=<?= $row["id_kandidat"]; ?>"><img
									src="icon/pencil.png" width="20" title="Edit"></a>
							<a href="hapuskandidat.php?id_kandidat=<?= $row["id_kandidat"]; ?>"
								onclick="return confirm('Yakin?');"><img src="icon/cancel.png" width="20"
									title="Delete"></a> -->
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
				</table>
				</div>
			</div>
		</div>
		<?php
      		require('footer.php');
    	?>
	</div>
</body>
</html>