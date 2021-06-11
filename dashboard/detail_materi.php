<?php
session_start();
if($_SESSION['status'] !== true){
    header('Location: http://localhost/e-learning/auth/login');
}

include '../config/koneksi.php';
$id_materi = $_GET['id'];

$sql = "SELECT * FROM `materi` WHERE `id_materi` = '$id_materi'";

$result = mysqli_query($conn, $sql);

$output = array();

if (mysqli_num_rows($result) == 0) {
    echo "0 results";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = [
            'id_materi' => $row["id_materi"],
            'judul_materi' => $row["judul_materi"],
            'isi_materi' => $row["isi_materi"],
            'name_file' => $row["name_file"],
            'file' => $row["file"],
            'id_kelas' => $row["id_kelas"],
        ];
    }

    $data = ['data' => $output];
    header('Content-Type: application/json');
    echo json_encode($data);
}
