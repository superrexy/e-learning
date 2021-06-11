<?php
include '../config/koneksi.php';
$uploadDir = '../assets/files/materi/';

$judul_materi = $_POST['judul_materi'];
$isi_materi = $_POST['isi_materi'];
$id_materi = $_POST['id_materi'];

if(empty($_FILES['file_materi']['tmp_name'])){
    $sql = "UPDATE materi SET judul_materi = '$judul_materi', isi_materi = '$isi_materi' WHERE id_materi = '$id_materi'";
} else {
    $filename = $_FILES['file_materi']['name'];
    $tmpName = $_FILES['file_materi']['tmp_name'];
    $location = $uploadDir . $filename;
    $result = move_uploaded_file($tmpName, $location);

    $sql = "UPDATE materi SET judul_materi = '$judul_materi', isi_materi = '$isi_materi', name_file = '$filename', file = '$location' WHERE id_materi = '$id_materi'";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "success";
} else {
    echo mysqli_error($conn);
}
?>