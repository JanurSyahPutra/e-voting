<?php

include 'db.php';

	function upload(){
		$namafile = $_FILES['gambar']['name'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		// cek upload
		// if($error){
		// 	echo "<script>
		// 	alert('pilih gambar terlebih dahulu')</script>";
		// 	return false;
		// }
		// cek format foto/gambar
		$format = ['jpg','jpeg','png'];
		$format1 = explode('.', $namafile);
		$format1 = strtolower(end($format1));

		//mengatasi nama file yang sama
		$namafile1 = uniqid();
		$namafile1 .= '.';
		$namafile1 .= $format1;
		move_uploaded_file($tmpName, 'img/'. $namafile1);
		return $namafile1;

	}

?>