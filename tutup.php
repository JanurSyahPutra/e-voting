<?php

include 'db.php';

$ubah_status = "UPDATE status SET status = 'Tutup' ";
if(mysqli_query($conn, $ubah_status)){
	echo "<script>
		alert('Pemilihan Berhasil Ditutup!')
		document.location.href = 'admin.php';
		</script>";
}

?>