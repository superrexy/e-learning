<?php
include '../config/koneksi.php';
$id_nilai = isset($_GET['id']);
$id_tugas = isset($_GET['id_tugas']);
$id_mahasiswa = isset($_GET['id_mahasiswa']);

if(empty($id_nilai)){
    $sql = "SELECT * FROM detail_tugas INNER JOIN mahasiswa ON mahasiswa.id_mahasiswa = detail_tugas.id_mahasiswa WHERE detail_tugas.id_tugas = $id_tugas AND detail_tugas.id_mahasiswa = $id_mahasiswa";
} else {
    $sql = "SELECT * FROM detail_tugas INNER JOIN mahasiswa ON mahasiswa.id_mahasiswa = detail_tugas.id_mahasiswa WHERE id = $id_nilai";
}

$result = mysqli_query($conn, $sql);

$output = array();

if(mysqli_num_rows($result) == 0){
    echo "0 results";
} else {
    while($row = mysqli_fetch_assoc($result)) {
        $output[] = [
            'id' => $row["id"],
            'id_mahasiswa' => $row["id_mahasiswa"],
            'id_tugas' => $row["id_tugas"],
            'nama' => $row["nama"],
            'nilai' => $row["nilai"],
        ];
    }

    $data = ['data' => $output];
    header('Content-Type: application/json');
    echo json_encode($data);
}
