<?php
include '../config/koneksi.php';

$id_tugas = $_GET['id'];
$sql = "DELETE FROM tugas WHERE id_tugas = '$id_tugas'";
$result = mysqli_query($conn, $sql);

if($result){
    echo "success";
} else {
    echo mysqli_error($conn);
}
?>