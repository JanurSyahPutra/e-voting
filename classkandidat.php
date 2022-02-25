<?php

include 'db.php';
include 'upload.php';
$conn = mysqli_connect("localhost", "root", "", "e_voting");

class Kandidat
{
	private $id,
			$id_kandidat,
			$gambar,
			// $gambarlama,
			$namaketua,
			$namawakil,
			$visi,
			$misi,
			$jml;

	public function tambahkan($data)
	{
		global $conn;
		$this->id_kandidat = $data['id_kandidat'];
		$this->gambar = upload();
		if (!$this->gambar) {
			return false;
		}
		$this->namaketua = $data['namaketua'];
		$this->namawakil = $data['namawakil'];
		$this->visi = $data['visi'];
		$this->misi = $data['misi'];
		$this->jml = $data['jml'];

		$query = "INSERT INTO kandidat VALUES ('','$this->id_kandidat','$this->gambar','$this->namaketua','$this->namawakil','$this->visi','$this->misi','$this->jml')";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	public function ubahkan($data)
	{
		global $conn;
		$this->id = $data['id'];
		$this->id_kandidat = $data['id_kandidat'];
		if ($_FILES['gambar']['error']) {
			$this->gambar = $data["gambarlama"];
		} else {
			$this->gambar = upload();
		}
		// }
		// if (isset($_POST['ubah'])) {
		// 	$this->gambar = upload();
		// }
		$this->namaketua = $data['namaketua'];
		$this->namawakil = $data['namawakil'];
		$this->visi = $data['visi'];
		$this->misi = $data['misi'];
		$this->jml = $data['jml'];

		

		$query = "UPDATE kandidat SET id_kandidat = '$this->id_kandidat', gambar = '$this->gambar', namaketua = '$this->namaketua', namawakil = '$this->namawakil', visi = '$this->visi', misi = '$this->misi', jml = '$this->jml' WHERE id = '$this->id' ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	public function hapuskan($id)
	{
		global $conn;
		mysqli_query($conn, "DELETE FROM kandidat WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}
}

// function upload(){
// 		$namafile = $_FILES['gambar']['name'];
// 		$error = $_FILES['gambar']['error'];
// 		$tmpName = $_FILES['gambar']['tmp_name'];

// 		// cek upload
// 		if($error === 3){
// 			echo "<script>
// 			alert('pilih gambar terlebih dahulu')</script>";
// 			return false;
// 		}
// 		// cek format foto/gambar
// 		$format = ['jpg','jpeg','png'];
// 		$format1 = explode('.', $namafile);
// 		$format1 = strtolower(end($format1));

// 		//mengatasi nama file yang sama
// 		$namafile1 = uniqid();
// 		$namafile1 .= '.';
// 		$namafile1 .= $format1;
// 		move_uploaded_file($tmpName, 'img/'.$namafile1);
// 		return $namafile1;

// 	}

?>