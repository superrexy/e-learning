<?php
session_start();
if ($_SESSION['status'] !== true) {
    header('Location: http://e-learning.test/auth/login');
}

include '../config/koneksi.php';

if (isset($_GET['id_tugas'])) {
    $id_tugas = $_GET['id_tugas'];
    $id_mahasiswa = $_GET['id_mahasiswa'];
    $sql = "SELECT * FROM detail_tugas WHERE id_tugas = $id_tugas AND id_mahasiswa = $id_mahasiswa";
    $result = mysqli_query($conn, $sql);

    $output = array();

    if (mysqli_num_rows($result) == 0) {
        $output[] = ['message' => 'null'];
        $data = ['data' => $output];
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = [
                'id_mahasiswa' => $row["id_mahasiswa"],
                'id_tugas' => $row["id_tugas"],
                'id_kelas' => $row["id_kelas"],
                'name_file' => $row["name_file"],
                'file' => $row["file"],
                'nilai' => $row["nilai"],
            ];
        }

        $data = ['data' => $output];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
