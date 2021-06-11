<?php
include '../../config/koneksi.php';

if (isset($_POST['dosen'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 12,
    ]);

    $sql = "INSERT INTO dosen VALUES (null, '$nip', '$nama', '$username', '$password_hash')";

} else {
    $nrp = $_POST['nrp'];
    $nama = $_POST['nama'];
    $nomer_telp = $_POST['nomer_telp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 12,
    ]);

    $sql = "INSERT INTO mahasiswa VALUES (null, '$nrp', '$nama', '$nomer_telp', '$username', '$password_hash')";
}

if (mysqli_query($conn, $sql)) {
    echo "success";

} else {

    echo "error";
}

mysqli_close($conn);
