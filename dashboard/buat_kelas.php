<?php
include '../config/koneksi.php';

$nama_kelas = $_POST['nama_kelas'];
$desc_kelas = $_POST['desc_kelas'];
$token_kelas = $_POST['token_kelas'];
$id_dosen = $_POST['id_dosen'];

$sql = "INSERT INTO kelas VALUES (null, '$nama_kelas', '$desc_kelas', '$token_kelas', '$id_dosen')";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error";
}

?>
