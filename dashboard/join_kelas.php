<?php
include '../config/koneksi.php';

if (isset($_POST['token_kelas'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $token_kelas = $_POST['token_kelas'];

    $ambiltoken = "SELECT * FROM kelas WHERE token_kelas = '$token_kelas'";
    $result = mysqli_query($conn, $ambiltoken);
    $data = mysqli_fetch_array($result);

    $cekDuplikasi = "SELECT * FROM kelas_detail WHERE (id_mahasiswa = $id_mahasiswa AND id_kelas = $data[id_kelas])";

    if ($token_kelas == $data['token_kelas']) {
        if (mysqli_num_rows(mysqli_query($conn, $cekDuplikasi)) > 0) {
            echo "Duplikasi Data";
        } else {
            $tambahKelas = "INSERT INTO kelas_detail VALUES (null, '$id_mahasiswa', '$data[id_kelas]')";
            $resultKelas = mysqli_query($conn, $tambahKelas);
            if ($resultKelas) {
                echo "success";
            } else {
                echo "error";
            }
        }
    } else {
        echo "error";
    }
}
