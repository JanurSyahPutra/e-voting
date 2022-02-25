<?php

include 'db.php';
include 'classpemilih.php';
$pml = new Pemilih();

$id_pemilih = $_GET["id_pemilih"];
$sql2 = "UPDATE pemilih SET statusverify = 'Terverifikasi' WHERE id_pemilih = '$id_pemilih'";
if(mysqli_query($conn, $sql2)){
	echo "<script>
		alert('Verifikasi Berhasil')
		document.location.href = 'datapemilih.php';
		</script>";
}

?>