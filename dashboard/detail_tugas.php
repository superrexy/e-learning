<?php
session_start();
if($_SESSION['status'] !== true){
    header('Location: http://e-learning.test/auth/login');
}

include '../config/koneksi.php';
$id_tugas = $_GET['id'];
$sql = "SELECT * FROM `tugas` WHERE `id_tugas` = '$id_tugas'";
$result = mysqli_query($conn, $sql);

$output = array();

if(mysqli_num_rows($result) == 0){
    echo "0 results";
} else {
    while($row = mysqli_fetch_assoc($result)) {
        $output[] = [
            'id_tugas' => $row["id_tugas"],
            'nama_tugas' => $row["nama_tugas"],
            'detail_tugas' => $row["detail_tugas"],
            'name_file' => $row["name_file"],
            'file' => $row["file"],
            'created_at' => $row["created_at"],
            'deadline' => $row["deadline"],
            'deadline_format' => date("d F Y", strtotime($row["deadline"])),
        ];
    }

    $data = ['data' => $output];
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>