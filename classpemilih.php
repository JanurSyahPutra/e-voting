<?php

include 'db.php';
$conn = mysqli_connect("localhost", "root", "", "e_voting");

class Pemilih
{
	private $id_pemilih,
			$password,
			$nama,
			$status,
			$jenis_kelamin,
			$votestatus,
			$statusverify;
	
	public function tambah($data)
	{
		global $conn;
		$this->id_pemilih = $data['id_pemilih'];
		$this->password = $data['password'];
		$this->nama = $data['nama'];
		$this->status = $data['status'];
		$this->jenis_kelamin = $data['jenis_kelamin'];
		$this->votestatus = $data['votestatus'];
		$this->statusverify = $data['statusverify'];


		$query = "INSERT INTO pemilih VALUES ('$this->id_pemilih','$this->password','$this->nama','$this->status','$this->jenis_kelamin','$this->votestatus','$this->statusverify')";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	public function ubah($data)
	{
		global $conn;
		$this->id_pemilih = $data['id_pemilih'];
		$this->password = $data['password'];
		$this->nama = $data['nama'];
		$this->status = $data['status'];
		$this->jeniskelamin = $data['jenis_kelamin'];
		$this->votestatus = $data['votestatus'];
		$this->statusverify = $data['statusverify'];

		$query = "UPDATE pemilih SET id_pemilih = '$this->id_pemilih', password = '$this->password', nama = '$this->nama', status = '$this->status', jenis_kelamin = '$this->jeniskelamin', votestatus = '$this->votestatus', statusverify = '$this->statusverify' WHERE id_pemilih = '$this->id_pemilih' ";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	public function hapus($id_pemilih)
	{
		global $conn;
		mysqli_query($conn, "DELETE FROM pemilih WHERE id_pemilih = $id_pemilih ");
		return mysqli_affected_rows($conn);
	}

	public function login($id_pemilih, $password)
	{
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_pemilih = '$id_pemilih' AND password = '$password'");
		$data = mysqli_fetch_array($cek);
		$result = mysqli_num_rows($cek);
		if ($result == 1) {
			$_SESSION['login'] = true;
			$_SESSION['id_pemilih'] = $data['id_pemilih'];
			return true;
		}else{
			return false;
		}
	}

	public function regis($id_pemilih, $password, $nama, $status, $jenis_kelamin, $votestatus, $statusverify)
	{
		global $conn;
		$query = mysqli_query($conn, "SELECT * FROM pemilih WHERE id_pemilih = $id_pemilih ");
		$result = mysqli_num_rows($query);
		if ($result == 0) {
			$regis = mysqli_query($conn, "INSERT INTO pemilih (id_pemilih, password, nama, status, jenis_kelamin, votestatus, statusverify) VALUES ('$id_pemilih','$password','$nama','$status','$jenis_kelamin','$votestatus','$statusverify')") or die(mysqli_error($conn));
			return $regis;
		}else{
			return false;
		}
	}

	public function session()
	{
		if (isset($_SESSION['login'])) {
			return $_SESSION['login'];
		}
	}

	public function logout()
	{
		$_SESSION['login'] = false;
		session_destroy();
	}
}

?>