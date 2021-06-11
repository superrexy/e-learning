<?php
include '../config/koneksi.php';

$uploadDir = '../assets/files/tugas_mahasiswa/';

$id_mahasiswa = $_POST['id_mahasiswa'];
$id_tugas = $_POST['id_tugas'];
$id_kelas = $_POST['id_kelas'];

if (empty($_FILES['file_tugas_mahasiswa']['tmp_name'])) {
    $location = "";
    $filename = "";
} else {
    $filename = $_FILES['file_tugas_mahasiswa']['name'];
    $tmpName = $_FILES['file_tugas_mahasiswa']['tmp_name'];
    $location = $uploadDir . $filename;
    $result = move_uploaded_file($tmpName, $location);
}

$cekDuplikasi = "SELECT * FROM detail_tugas WHERE (id_mahasiswa = $id_mahasiswa AND id_tugas = $id_tugas)";

if (mysqli_num_rows(mysqli_query($conn, $cekDuplikasi)) > 0) {
    echo "Duplikasi Data";
} else {
    $sql = "INSERT INTO detail_tugas VALUES (null, '$id_mahasiswa', '$id_tugas', '$id_kelas', '$filename', '$location', null, now())";
    $resultUpload = mysqli_query($conn, $sql);
    if ($resultUpload) {
        echo "success";
    } else {
        echo mysqli_error($conn);
    }
}
