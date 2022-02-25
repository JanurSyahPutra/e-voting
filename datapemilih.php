<?php
session_start();
include 'classadmin.php';
include 'classpemilih.php';
$adm = new Admin();
$pml = new Pemilih();
// $username = $_SESSION['username'];

 if (!$adm->session()) {
    header("location:loginadmin.php");
  }

  if (isset($_GET['q'])) {
    $adm->logout();
    header("location:loginadmin.php");
  }

$conn = mysqli_connect("localhost","root", "", "e_voting");

// ambil
$result = mysqli_query($conn, "SELECT * FROM pemilih");

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
							<h2 class="text-success">Data Pemilih</h2>
						</div>
						<div class="col">
							<h4 class="text-end"><a href="tambahpemilih.php"
									class="btn btn-outline-success">Tambah Data Pemilih</a></h4>
						</div>
					</div>
				</div>

				<div class="table-responsive">
				<table class="table table-hover border-dark">
					<thead class="thead bg-success">
						<tr>
  							<th class="text-center text-light" >#</th>
							<th class="text-center text-light">ID Pemilih</th>
							<th class="text-center text-light">Password</th>
							<th class="text-center text-light">Nama</th>
							<th class="text-center text-light">Status</th>
							<th class="text-center text-light">Jenis kelamin</th>
							<th class="text-center text-light">Status Vote</th>
							<th class="text-center text-light">Status Verifikasi</th>
							<th class="text-center text-light">Aksi</th>
						</tr>
					</thead>

					<?php 
					$i = 1;
					foreach ($result as $row): ?>

					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						<td class="text-center"><?= $row["id_pemilih"]; ?></td>
						<td class="text-center"><?= $row["password"]; ?></td>
						<td class="text-center"><?= $row["nama"]; ?></td>
						<td class="text-center"><?= $row["status"]; ?></td>
						<td class="text-center"><?= $row["jenis_kelamin"]; ?></td>
						<td class="text-center"><?= $row["votestatus"]; ?></td>
						<td class="text-center"><?= $row["statusverify"]; ?></td>
						<td class="text-center">
							<div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
							<button type="button" class="btn btn-success"><a class="text-decoration-none text-light" href="verifikasi.php?id_pemilih=<?= $row["id_pemilih"]; ?>">Verifikasi</a></button>
							<button type="button" class="btn btn-info"><a class="text-decoration-none text-light" href="ubahdatapemilih.php?id_pemilih=<?= $row["id_pemilih"]; ?>">Edit</a></button>
							<button type="button" class="btn btn-danger"><a class="text-decoration-none text-light"href="hapusdatapemilih.php?id_pemilih=<?= $row["id_pemilih"]; ?>"
									onclick="return confirm('Anda Yakin Ingin Mengahpus Data Ini?');">Hapus</a></button>
							</div>
							<!-- <a href="verifikasi.php?id_pemilih=<?= $row["id_pemilih"]; ?>"><button
									class="btn btn-outline-dark">Verifikasi</button>
								<a href="ubahdatapemilih.php?id_pemilih=<?= $row["id_pemilih"]; ?>"><img
										src="icon/pencil.png" width="20" title="Edit"></a>
								<a href="hapusdatapemilih.php?id_pemilih=<?= $row["id_pemilih"]; ?>"
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