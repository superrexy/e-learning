<?php
include '../config/koneksi.php';
$id_nilai = $_POST['id'];
$nilai = $_POST['nilai'];

$sql = "UPDATE detail_tugas SET nilai = $nilai WHERE id = $id_nilai";
$result = mysqli_query($conn, $sql);

if($result){
    echo "success";
} else {
    echo mysqli_error($conn);
}

?>