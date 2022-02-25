<?php

include 'db.php';
$conn = mysqli_connect("localhost", "root", "", "e_voting");

class Admin
{
	private $username,
			$password,
			$nama;

	public function loginad($username, $password)
	{
		global $conn;
		$cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password' ");
		$data = mysqli_fetch_assoc($cek);
		$result = mysqli_num_rows($cek);
		if ($result == 1) {
			$_SESSION['login'] = true;
			$_SESSION['username'] = $data['username'];
			return true;
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