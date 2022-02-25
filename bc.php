 <!-- <nav class="navbar navbar-expand-lg" style="background-color: #a8dba8; ">
  <a class="navbar-brand" style="color: #2b2b2b;"><img src="icon/logotit.png" width="30" height="30" class="d-inline-block align-top" alt="">
  EV
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
  <li class="nav-item">
    <a class="nav-link" href="pemilih.php" style="color: #2b2b2b;"><img src="icon/home.png" width="20" class="d-inline-block align-top"> Beranda</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="calonkandidat.php" style="color: #2b2b2b;"><img src="icon/vote.png" width="20" class="d-inline-block align-top"> Perolehan Suara</a>
    </li>
    </ul>
  </div>
  <a href="?q=logout" class="btn btn-outline-dark"><img src="icon/logout.png" width="20" class="d-inline-block align-top"> Logout</a>
</nav> -->

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
  <div class="container mt-5">
  <?php
  require('navbar_user.php');
  ?>
  <h4 class="">Selamat Datang <?php echo $pemilih["nama"] ?></h4>
  <div class="card mt-2">
    <div class="car-body">
      
    </div>
  </div>
    <div class="row">
      <div class="col-sm-5" style="border-right: 4px solid #79bd9a;">
      <p><h4 class="text1">Profil</h4></p>
      <form>
        <h5>
        <div class="form-group row">
          <label for = "id_pemilih" class="col col-form-label">ID Pemilih</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["id_pemilih"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["nama"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["status"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Jenis Kelamin</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["jenis_kelamin"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status Vote</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["votestatus"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status Verifikasi</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value=": <?= $pemilih["statusverify"]; ?>">
        </div>
        </div>
      </h5>
      </form>
      <?php
      $skrg = date("Y-m-d");
      $k = "2020-04-17";
      $sql = "SELECT * FROM pemilih where id_pemilih = '$id_pemilih'";
      $result = mysqli_query($conn, $sql);
      $row2 = mysqli_fetch_assoc($result);
      if ($skrg >= $k) {
        ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>O OW...,Maaf Waktu Pemilihan Berakhir</strong>
      </div><?php
      }else{
      if ($row2["statusverify"] == "Belum") {
        ?><div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Anda Belum Terverifikasi!</strong> Silahkan Hubungi Admin
      </div><?php
      } elseif ($row2["statusverify"] == "Terverifikasi") {
        if ($row2["votestatus"] == "Belum") {
          ?><label class="text1">Anda Belum Memilih,</label> <a href="calonkandidat.php"><button class="btn btn-outline-dark">Ayo Memilih</button></a><?php
        }
      }
    }
      ?>
    </div>
  <div class="col-sm-7"><p><h4 class="text1">Perolehan Suara Sementara Para Calon Kandidat</h4></p>
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
    <h5 class="text1" >Calon Kandidat <?= $row["nokandidat"] ?></h5>
    <h5 class="text1"><?= $row["namaketua"] ?> - <?= $row["namawakil"] ?></h5>
    <div class="progress">
      <div class="progress-bar" style="background:  #79bd9a; width: <?php echo $persen; echo "%";?>"><?php echo $persen; echo "%";?></div>
    </div>
    <p></p>
    <?php
    ?>
    <?php endforeach; ?>
    </div>
    <div class="container" style ="margin: 50px auto">
      <h4 class="text1" style="text-align: center;">Bantuan</h4>
    <div class="row" style="border-top: 3px solid #79bd9a;">
    <div class="col-sm-8">
      <dl>
        <dt><h4 class="text1">Cara Verifikasi Akun ?</h4></dt>
        <dd><h5 class="text1">Panitia akan langsung mem-verifikasi akun anda, jika akun anda tidak kunjung diverifikasi, segera hubungi panitia.</h5></dd>
        <dt><h4 class="text1">Durasi Pemilihan</h4></dt>
        <dd><h5 class="text1">Pemilihan akan berlangsung selama satu hari penuh, pemilihan akan ditutup pada jam 00.00 melebihi itu pemilih tidak akan bisa menggunakan suaranya.</h5></dd>
      </dl>
    </div>
    </div>
    </div>
</div>
</div>
</body>
</html>
    <!-- <div class="container rounded" style="border: 1px solid black;">
      <p><h4 class="text1">Profil</h4></p>
      <form>
        <div class="form-group row">
          <label for = "id_pemilih" class="col col-form-label">ID Pemilih</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["id_pemilih"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["nama"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["status"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["jenis_kelamin"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status Verifikasi</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["statusverify"]; ?>">
        </div>
        </div>
      </form>
    </div> -->



        <!-- <div class="container rounded" style="border: 1px solid black;">
      <p><h4 class="text1">Profil</h4></p>
      <form>
        <div class="form-group row">
          <label for = "id_pemilih" class="col col-form-label">ID Pemilih</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["id_pemilih"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["nama"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["status"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["jenis_kelamin"]; ?>">
        </div>
        </div>
        <div class="form-group row">
          <label for = "nama" class="col col-form-label">Status Verifikasi</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="<?= $pemilih["statusverify"]; ?>">
        </div>
        </div>
      </form>
    </div> -->


        <!-- <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>O OW...,Maaf Waktu Pemilihan Berakhir</strong>
      </div> -->




// PROSES VOTING
                  <!-- <?php 
            $skrg = date("Y-m-d");
            $k = "2020-04-17";
            $sql = "SELECT * FROM pemilih where id_pemilih = '$id_pemilih'";
            $result = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result);
            // $row = $result->fetch_assoc();
            if ($skrg >= $k) {
              ?><div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Yaah... maaf ya <?php echo $pemilih["nama"] ?>!, </strong> Waktu Pemilihan Sudah Berakhir.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div><?php
            }else{
            if ($row2["statusverify"] == "Belum") {
              ?><div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong><?php echo $pemilih["nama"] ?>!, Anda Belum Diverifikasi.</strong> Silahkan Hubungi Admin.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div><?php
            }
            elseif ($row2["votestatus"] == "Sudah" ) {
              ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Terimakasih Sudah Memilih <?php echo $pemilih["nama"] ?>!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }else{
              ?>
              <a href="prosesvoting.php?id_kandidat=<?=$row["id_kandidat"]?>" onclick="return confirm('Yakin dengan Pilihan anda?');"><button class="btn btn-outline-dark"><img src="icon/select.png" width="20" class="d-inline-block align-top"> Pilih</button></a><?php
            }
          }
            ?>
            <!-- <a href="prosesvoting.php?id_kandidat=<?=$row["id_kandidat"]?>"><button class="btn btn-outline-dark">Pilih</button></a> -->
            </ul>