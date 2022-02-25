<?php

include 'classpemilih.php';
$pml = new Pemilih();

$id_pemilih = $_GET["id_pemilih"];

if ($pml->hapus($id_pemilih)) {
	echo "
	<script>
		alert('Pemilih Berhasil Dihapus!');
		document.location.href = 'datapemilih.php';
		</script>
		";
} else {
	echo "
	<script>
		alert('Pemilih Gagal Dihapus!');
		document.location.href = 'datapemilih.php';
		</script>
		";
}
?>