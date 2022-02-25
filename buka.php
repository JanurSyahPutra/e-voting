<?php

include 'db.php';

$ubah_status = "UPDATE status SET status = 'Buka' ";
if(mysqli_query($conn, $ubah_status)){
	echo "<script>
		alert('Pemilihan Berhasil Dibuka!')
		document.location.href = 'admin.php';
		</script>";
}

?>