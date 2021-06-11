<?php
include '../config/koneksi.php';
$uploadDir = '../assets/files/tugas/';

$nama_tugas = $_POST['nama_tugas'];
$detail_tugas = $_POST['detail_tugas'];
$deadline = $_POST['deadline'];
$id_tugas = $_POST['id_tugas'];

if(empty($_FILES['file_tugas']['tmp_name'])){
    $sql = "UPDATE tugas SET nama_tugas = '$nama_tugas', detail_tugas = '$detail_tugas', deadline = '$deadline' WHERE id_tugas = '$id_tugas'";
} else {
    $filename = $_FILES['file_tugas']['name'];
    $tmpName = $_FILES['file_tugas']['tmp_name'];
    $location = $uploadDir . $filename;
    $result = move_uploaded_file($tmpName, $location);

    $sql = "UPDATE tugas SET nama_tugas = '$nama_tugas', detail_tugas = '$detail_tugas', name_file = '$filename', file = '$location', deadline = '$deadline' WHERE id_tugas = '$id_tugas'";
}

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo mysqli_error($conn);
}

?>