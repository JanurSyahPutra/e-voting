<?php

  session_start();
  include 'classpemilih.php';
  $pml = new Pemilih();
  $id_pemilih = $_SESSION['id_pemilih'];

  if (!$pml->session()) {
    header("location:index.php");
  }

  if (isset($_GET['q'])) {
    $pml->logout();
    header("location:index.php");
  }

  $query = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_pemilih = $id_pemilih");

  $pemilih = mysqli_fetch_assoc($query);

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
    require('navbar_user.php');
    ?>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <strong>Selamat Datang!</strong> <?php echo $pemilih["nama"] ?>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card mt-2 mb-2">
      <div class="car-body p-3">
            <h3 class="card-title">Profil Pemilih</h3>
            <hr>
            <form>
              <h5>
                <div class="form-group row">
                  <label for="id_pemilih" class="col col-form-label">ID Pemilih</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["id_pemilih"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col col-form-label">Nama Pemilih</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["nama"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col col-form-label">Status Pemilih</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["status"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext"
                      value=": <?= $pemilih["jenis_kelamin"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col col-form-label">Status Vote</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["votestatus"]; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama" class="col col-form-label">Status Verifikasi</label>
                  <div class="col-sm-9">
                    <input type="text" readonly class="form-control-plaintext"
                      value=": <?= $pemilih["statusverify"]; ?>">
                  </div>
                </div>
              </h5>
            </form>
            <?php
            // Status
              $status = mysqli_query($conn, "SELECT * FROM status");
              $status_pml = mysqli_fetch_assoc($status);

              // Waktu
              $waktu = mysqli_query($conn, "SELECT * FROM waktu");
              $waktu_pml = mysqli_fetch_assoc($waktu);
              $cek = mysqli_num_rows($waktu);
              $skrg = date("Y-m-d");

              $sql = "SELECT * FROM pemilih where id_pemilih = '$id_pemilih'";
              $result = mysqli_query($conn, $sql);
              $row2 = mysqli_fetch_assoc($result);
              if ($status_pml["status"] == "Tutup") {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Yaah... maaf ya <?php echo $pemilih["nama"] ?>!, </strong> Pemilihan Sudah Ditutup.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
              } elseif ($cek == 0) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Yaah... maaf ya <?php echo $pemilih["nama"] ?>!, </strong> Waktu Pemilihan Belum Diset.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
              } else {
                if ($skrg < $waktu_pml["mulai"]){
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Maaf ya <?php echo $pemilih["nama"] ?>!, </strong> Waktu Pemilihan Belum Dimulai.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                elseif ($skrg > $waktu_pml["selesai"]) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Yaah... maaf ya <?php echo $pemilih["nama"] ?>!, </strong> Waktu Pemilihan Sudah Berakhir.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
              }else{
              if ($row2["statusverify"] == "Belum") {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong><?php echo $pemilih["nama"] ?>!, Anda Belum Diverifikasi.</strong> Silahkan Hubungi Admin.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
              } elseif ($row2["statusverify"] == "Terverifikasi") {
                if ($row2["votestatus"] == "Belum") {
                  ?><label class="text1"><?php echo $pemilih["nama"] ?>, Anda Belum Memilih Ya ?,</label> <a
                      href="calonkandidat.php"><button class="btn btn-outline-success">Ayo Memilih</button></a><?php
                }
              }
            }
            }
            ?>
            <a href="ubahpemilih.php?id_pemilih=<?= $pemilih["id_pemilih"]; ?>"><button type="button" class="btn btn-primary">Edit Data</button></a>
      </div>
    </div>
    <div class="card">
      <div class="card-header fs-4">
        Bantuan
      </div>
      <div class="car-body p-3">

        <dl>
          <dt>
            <h4 class="text-decoration-underline">Cara Verifikasi Akun ?</h4>
          </dt>
          <dd>
            <h5>Panitia akan segera mem-verifikasi akun anda dan jika akun anda tidak kunjung diverifikasi,
              segera hubungi panitia.</h5>
          </dd>
          <dt>
            <h4 class="text-decoration-underline">Durasi Pemilihan</h4>
          </dt>
          <dd>
            <h5>Durasi pemilihan akan diberitahukan pada saat sesi pemilihan sudah dibuka.</h5>
            <?php if ($cek == 0) {
            } else {
              ?>
            <h5>Mulai : <?= $waktu_pml["mulai"] ?></h5>
            <h5>Selesai : <?= $waktu_pml["selesai"] ?></h5>
         <?php } ?>
          </dd>
        </dl>
        <blockquote class="blockquote mb-0 text-end">
          <footer class="blockquote-footer"><cite title="Source Title">Admin EV</cite></footer>
        </blockquote>
      </div>
    </div>
    <?php
    require('footer.php');
    ?>
  </div>
</body>

</html>