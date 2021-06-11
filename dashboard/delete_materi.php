<?php
include '../config/koneksi.php';

$id_materi = $_GET['id'];
$sql = "DELETE FROM materi WHERE id_materi = '$id_materi'";
$result = mysqli_query($conn, $sql);

if($result){
    echo "success";
} else {
    echo mysqli_error($conn);
}
?>