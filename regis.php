<?php
include "classpemilih.php";
$pml = new Pemilih();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$password = $_POST["password"];
	if (strlen($password) < 6) {
		echo "<script>
			alert('Password Minimal 6 Karakter !');
			document.location.href = 'index.php';
		</script>";
	} else { 
	$regis = $pml->regis($_POST['id_pemilih'], $_POST['password'], $_POST['nama'], $_POST['status'], $_POST['jenis_kelamin'], $_POST['votestatus'], $_POST['statusverify']);
	if ($regis > 0) {
		echo "<script>
		alert('Registrasi Berhasil!')
		document.location.href = 'index.php';
		</script>";
	}else{
		echo "<script>alert('Registrasi Gagal!')
		document.location.href = 'index.php'</script>";
	}
}
}