<?php
include '../config/koneksi.php';
$uploadDir = '../assets/files/materi/';

$judul_materi = $_POST['judul_materi'];
$isi_materi = $_POST['isi_materi'];

if(empty($_FILES['file']['tmp_name'])){
    $location = "";
    $filename = "";
} else {
    $filename = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];
    $location = $uploadDir . $filename;
    $result = move_uploaded_file($tmpName, $location);
}

$id_kelas = $_POST['id_kelas'];

$sql = "INSERT INTO materi VALUES (null, '$judul_materi', '$isi_materi', '$filename', '$location', '$id_kelas')";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo mysqli_error($conn);
}

?>