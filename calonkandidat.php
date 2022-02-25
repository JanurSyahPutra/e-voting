<?php

session_start();
include 'classpemilih.php';
$obj = new Pemilih();
$id_pemilih = $_SESSION['id_pemilih'];

if (!$obj->session()) {
    header("location:index.php");
  }

if (isset($_GET['q'])) {
    $obj->logout();
    header("location:index.php");
  }

$query = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_pemilih = $id_pemilih");

$pemilih = mysqli_fetch_assoc($query);
    // $sql = "SELECT * FROM pemilih where id_pemilih = '$id_pemilih'";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    // // $row = $result->fetch_assoc();
    // if ($row["status"] == 1 ) {
    //     echo "ANDA SUDAH MEMILIH!";
    // }
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
  require('navbar_user.php');
  ?>

    <div class="card mt-2 mb-2">
      <div class="card-body p-3">
        <h3 class="text-center">Form Pemilihan</h3>
        <hr>
        <div class="row">
          <?php 
            $conn = mysqli_connect("localhost", "root", "", "e_voting");
            $result = mysqli_query($conn, "SELECT * FROM kandidat");

            foreach ($result as $row): ?>

          <div class="col">
            <div class="card w-100">
              <img src="img/<?= $row["gambar"]; ?>" class="card-img-top" width="100" height="200" alt="...">
              <div class="card-header h4">Kandidat <?= $row["id_kandidat"]; ?></div>
              <div class="card-body">
                <h4 class="card-title">Nama Ketua : <?= $row["namaketua"] ?></h4>

                <h4 class="card-title">Nama Wakil : <?= $row["namawakil"] ?></h4>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <h5>Visi Calon Kandidat</h5>
                  <h5 class="text1"><?= $row["visi"] ?></h5>
                </li>
                <li class="list-group-item">
                  <h5>Misi Calon Kandidat</h5>
                  <h5 class="text1"><?= $row["misi"] ?></h5>
                </li>
              </ul>
              <div class="card-body">
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
                  } elseif ($row2["votestatus"] == "Sudah") {
                      ?><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Terimakasih Sudah Memilih, <?php echo $pemilih["nama"] ?>!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div><?php
                  } else {
                    ?>
                    <div class="text-center">
                    <a href="prosesvoting.php?id_kandidat=<?=$row["id_kandidat"]?>" onclick="return confirm('Yakin dengan Pilihan anda?');"><button class="btn btn-success w-50">Pilih</button></a>
                    </div>
                    <?php
                  }
                }
                }
                  ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php
  require('footer.php');
  ?>
  </div>
</body>

</html>