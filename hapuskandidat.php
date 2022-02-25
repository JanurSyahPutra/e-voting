<?php

include "classkandidat.php";
$kan = new Kandidat();

$id = $_GET["id"];

if ($kan->hapuskan($id)) {
	echo "
	<script>
		alert('Calon Kandidat Berhasil Dihapus!');
		document.location.href = 'datakandidat.php';
		</script>
		";
} else {
	echo "
	<script>
		alert('Calon Kandidat Gagal Dihapus!');
		document.location.href = 'datakandidat.php';
		</script>
		";
}
?>