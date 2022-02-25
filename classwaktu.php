<?php

include 'db.php';
$conn = mysqli_connect("localhost", "root", "", "e_voting");

class Waktu
{
    private $id, $mulai, $selesai;

    public function tambahwaktu($data)
    {
        global $conn;
        $this->mulai = $data['mulai'];
        $this->selesai = $data['selesai'];

        $query = "INSERT INTO waktu VALUES ('','$this->mulai','$this->selesai')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    public function ubahwaktu($data)
    {
        global $conn;
        $this->id = $data['id'];
        $this->mulai = $data['mulai'];
        $this->selesai = $data['selesai'];

        $query = "UPDATE waktu SET id = '$this->id', mulai = '$this->mulai', selesai = '$this->selesai' ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    public function clearwaktu($id)
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM waktu WHERE id = $id");
        return mysqli_affected_rows($conn);
    }
}

?>