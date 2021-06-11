<?php
include '../config/koneksi.php';
$uploadDir = '../assets/files/tugas/';

$nama_tugas = $_POST['nama_tugas'];
$detail_tugas = $_POST['detail_tugas'];
$id_dosen = $_POST['id_dosen'];
$deadline = $_POST['deadline'];
if(empty($_FILES['file_tugas']['tmp_name'])){
    $location = "";
    $filename = "";
} else {
    $filename = $_FILES['file_tugas']['name'];
    $tmpName = $_FILES['file_tugas']['tmp_name'];
    $location = $uploadDir . $filename;
    $result = move_uploaded_file($tmpName, $location);
}

$id_kelas = $_POST['id_kelas'];

$sql = "INSERT INTO tugas VALUES (null, '$nama_tugas', '$detail_tugas', '$filename', '$location', '$id_dosen', now(), '$deadline', '$id_kelas')";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo mysqli_error($conn);
}

?>