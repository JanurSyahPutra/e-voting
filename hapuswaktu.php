<?php

include "classwaktu.php";
$waktu = new Waktu();

$id = $_GET["id"];

if ($waktu->clearwaktu($id)) {
	echo "
	<script>
		alert('Waktu Pemilihan Berhasil Dihapus!');
		document.location.href = 'admin.php';
		</script>
		";
} else {
	echo "
	<script>
		alert('Waktu Pemilihan Gagal Dihapus!');
		document.location.href = 'admin.php';
		</script>
		";
}
?>