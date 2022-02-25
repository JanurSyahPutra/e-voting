<?php

  session_start();
  include 'classadmin.php';
  include "classwaktu.php";
  $adm = new Admin();
  $waktu = new Waktu();
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
	if ($waktu->tambahwaktu($_POST) > 0) {
		echo "<script>
		alert('Waktu Berhasil Ditambah!');
		document.location.href = 'admin.php';
		</script>";
	} else {
		echo "<script>
		alert('Waktu Gagal Ditambah!');
		document.location.href = 'admin.php';
		</script>";
	}
}

  $admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = $username");

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
  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body style="background: #F0F1EC;">
  <div class="container mt-2">
    <?php
      require('navbar_admin.php');
      $status = mysqli_query($conn, "SELECT * FROM status");
      $status_pml = mysqli_fetch_assoc($status);
    ?>
    <div class="card mt-2">
      <div class="card-body p-3">
        <?php
      if ($status_pml["status"] == "Tutup") {
        ?>
        <div class="row">
          <div class="col text-center border-end border-dark border-2">
            <h3 class="card-title">Status Pemilihan : <?= $status_pml["status"] ?></h3>
            <a class="text-decoration-none text-light btn btn-success" href="buka.php">Buka</a>
            <a class="text-decoration-none text-light btn btn-danger disabled" href="tutup.php">Tutup</a>
          </div>
          <div class="col text-center">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Oopss!</h4>
              <p>Status pemilihan masih ditutup, buka status pemilihan untuk set waktu mulai dan selesai.</p>
            </div>
          </div>
        </div>

        <?php
      } else {
          $waktu = mysqli_query($conn, "SELECT * FROM waktu");
          $waktu_pml = mysqli_fetch_assoc($waktu);
          $cek = mysqli_num_rows($waktu);

        ?>
        <div class="row">
          <div class="col text-center border-end border-dark border-2">
            <h3 class="card-title">Status Pemilihan : <?= $status_pml["status"] ?></h3>
            <a class="text-decoration-none text-light btn btn-success disabled" href="buka.php">Buka</a>
            <a class="text-decoration-none text-light btn btn-danger" href="tutup.php"
              onclick="return confirm('Anda Yakin Ingin Menutup Sesi Pemilihan?');">Tutup</a>
          </div>
          <div class="col text-center">
            <div class="row">
              <div class="col text-center">
                <?php
        if ($cek == 0) {
          ?>
                <h4 class="card-title">Waktu Pemilihan Kosong</h4>
                <?php
        } else {
          ?>
                <div class="col text-center">
                  <h5 class="card-title">Waktu Mulai : <?= $waktu_pml["mulai"] ?></h5>
                </div>
                <div class="col text-center">
                  <h5 class="card-title">Waktu Selesai : <?= $waktu_pml["selesai"] ?></h5>
                </div>
                <?php
        }
        
        ?>
                <a class="text-decoration-none text-light btn btn-info" href="hapuswaktu.php?id=<?= $waktu_pml["id"]; ?>"
                    onclick="return confirm('Anda Yakin Ingin Mengahpus Data Ini?');">Hapus Waktu Pemilihan</a>
                <?php
                if ($cek > 0) {
                  ?>
                  <button class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>Tambah Waktu Pemilihan</button>
                  <?php
                } else {
                  ?>
                  <button class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Waktu Pemilihan</button>
                  <?php
                }
                
                 ?>
              </div>
            </div>
          </div>
          </div>

          <!-- MODAL TAMBAH -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Masukan Waktu Pemilihan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="form-group mb-2">
                      <label>Waktu Mulai</label>
                      <input type="date" class="form-control" name="mulai" required="">
                    </div>

                    <div class="form-group mb-3">
                      <label>Waktu Selesai</label>
                      <input type="date" class="form-control" name="selesai" required="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="submit">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
       <?php
      }
    ?>
    </div>
      </div>
      <div class="card mt-2 mb-2">
        <div class="card-body p-3">
            <h2 class="text1">Perolehan Suara Para Calon Kandidat</h2>
          </p>
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
              $persen = number_format(($row["jml"]/$total) * 100, 2);
            }
            ?>
          <label for="namaketua" class="text1">Calon Kandidat <?= $row["id_kandidat"] ?></label>
          <p><?= $row["namaketua"] ?> - <?= $row["namawakil"] ?></p>
          <div class="progress">
            <div class="progress-bar" style="background:  #79bd9a; width: <?php echo $persen; echo "%";?>">
              <?php echo $persen; echo "%";?></div>
          </div>
          <?php


          ?>
          <?php endforeach; ?>
        </div>
        <div class="card-footer">
          <h4>Total Suara yang Masuk : <?php if ($total == 0) {
            echo "Kosong";
          } else {
            echo $total;
          } ?> </h4>
        </div>
      </div>
      <?php
      require('footer.php');
      ?>
    </div>
</body>

</html>