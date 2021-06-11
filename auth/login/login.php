<?php
session_start();
include '../../config/koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (isset($_POST['dosen'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM dosen WHERE username='$user'";
        $result = mysqli_query($conn, $sql);
        list($id_dosen, $nip, $nama, $username, $password) = mysqli_fetch_array($result);

        if (mysqli_num_rows($result) > 0) {
            if (password_verify($pass, $password)) {
                echo "success";
                $_SESSION['id'] = $id_dosen;
                $_SESSION['username'] = $username;
                $_SESSION['nama'] = $nama;
                $_SESSION['status'] = true;
                $_SESSION['role'] = "dosen";
                die();

            } else {
                echo "error";
            }
        }

    } else {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM mahasiswa WHERE username='$user'";
        $result = mysqli_query($conn, $sql);
        list($id_mahasiswa, $nrp, $nama, $nomer_telp, $username, $password) = mysqli_fetch_array($result);

        if (mysqli_num_rows($result) > 0) {
            if (password_verify($pass, $password)) {
                echo "success";
                $_SESSION['id'] = $id_mahasiswa;
                $_SESSION['username'] = $username;
                $_SESSION['nama'] = $nama;
                $_SESSION['status'] = true;
                $_SESSION['role'] = "mahasiswa";
                die();

            } else {
                echo "error";
            }
        }
    }
}
