<?php
include '../config/koneksi.php';
session_start();

if ($_SESSION['status'] !== true) {
    header('Location: http://localhost/e-learning/auth/login/');
    exit;

    if ($_SESSION['role'] !== "dosen") {
        header('Location: http://localhost/e-learning/dashboard');
    }
}

$id_kelas = $_GET['kelas'];
$id_tugas = $_GET['tugas'];

$sqlKelas = "SELECT * FROM kelas WHERE id_kelas = $id_kelas";
$resultKelas = mysqli_query($conn, $sqlKelas);
$dataskelas = mysqli_fetch_assoc($resultKelas);

$sqlTugas = "SELECT detail_tugas.id, detail_tugas.id_mahasiswa, detail_tugas.id_tugas, detail_tugas.id_kelas, detail_tugas.file, detail_tugas.nilai, detail_tugas.created_at, mahasiswa.nama, mahasiswa.nrp FROM `detail_tugas` INNER JOIN mahasiswa ON mahasiswa.id_mahasiswa = detail_tugas.id_mahasiswa WHERE detail_tugas.id_kelas = $id_kelas AND detail_tugas.id_tugas = $id_tugas ORDER BY `detail_tugas`.`created_at` ASC";
$resultTugas = mysqli_query($conn, $sqlTugas);

$sqlNamaTugas = "SELECT * FROM tugas WHERE id_tugas = $id_tugas";
$resultNamaTugas = mysqli_query($conn, $sqlNamaTugas);
$dataNamaTugas = mysqli_fetch_assoc($resultNamaTugas);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/icon.svg">
    <title>Virtual E-Learning</title>

    <!-- My CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Icons -->
    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-expand navbar-light position-relative">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/e-learning/dashboard">
                <img src="../assets/img/logo.svg" alt="SinauKuy">
            </a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto flex-row align-items-center profile">
                    <span class="nav-link" href="#"><img src="../assets/img/profile.png" alt="Profile" class="mx-3"><span>Hi, <?php echo $_SESSION['nama'] ?></span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header bg-gradient-blue p-4 mt-3 rounded-15">
            <div class="information-class">
                <p class="text-white main-title"><?php echo $dataskelas['nama_kelas']; ?></p>
                <p class="text-white h5"><?php echo $dataskelas['desc_kelas']; ?></p>
                <p class="text-white mt-5">Token Kelas <strong><?php echo $dataskelas['token_kelas']; ?></strong></p>
            </div>
        </div>

        <h3 class="text-center my-3">Pengumpulan Tugas <?php echo $dataNamaTugas['nama_tugas']; ?></h3>

        <div class="detail-nilai mt-3 table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-center">
                        <th scope="col">NRP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Dikumpulkan Tanggal</th>
                        <th scope="col">Nilai</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($resultTugas as $result) : ?>
                        <tr class="text-center">
                            <th><?php echo $result['nrp']; ?></th>
                            <td><?php echo $result['nama']; ?></td>
                            <td><a href="http://localhost/e-learning/assets/<?php echo $result['file']; ?>">Download Tugas</a></td>
                            <td><?php echo date("D, d F Y - H:i:s", strtotime($result['created_at'])); ?></td>
                            <td><?php echo ($result['nilai'] == null) ? "Nilai Belum Diinput" : $result['nilai'] ?></td>
                            <td><button type="button " class="btn-primary btn btn-ambil-id" data-target-mahasiswa="<?php echo $result['id_mahasiswa'] ?>" data-target-id="<?php echo $result['id'] ?>" data-bs-toggle="modal" data-bs-target="#formNilai">Nilai</button></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <!-- Modal Edit -->
            <div class="modal fade" id="formNilai" tabindex="-1" aria-labelledby="formNilaiLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formNilaiLabel">Form Penilaian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <fieldset disabled>
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Nama</label>
                                    <input type="text" id="disabledTextInput" class="form-control" name="nama_mahasiswa">
                                </div>
                            </fieldset>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nilai</label>
                                <input type="number" min=0 max=100 class="form-control" name="nilai_mahasiswa">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary btn-simpan-nilai">Simpan Nilai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(".btn-ambil-id").click(function() {
                let id_nilai = $(this).attr('data-target-id');

                localStorage.setItem('id_nilai', id_nilai);

                $.ajax({
                    url: "http://localhost/e-learning/dashboard/detail_nilai.php",
                    type: "GET",
                    data: {
                        "id": id_nilai,
                    }
                }).done(function(data) {
                    $("input[name='nama_mahasiswa']").val(data.data[0].nama);
                    $("input[name='nilai_mahasiswa']").val(data.data[0].nilai);
                })
            })

            $('.btn-simpan-nilai').click(function() {
                const id_nilai = localStorage.getItem('id_nilai');
                const nilai_mahasiswa = $("input[name='nilai_mahasiswa']").val();

                if (nilai_mahasiswa.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nilai Wajib Diisi !'
                    })
                } else {
                    $.ajax({
                        url: "simpan_nilai.php",
                        type: "POST",
                        data: {
                            "id": id_nilai,
                            "nilai": nilai_mahasiswa,
                        },

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Nilai Berhasil Disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Nilai Gagal Disimpan !'
                                })
                            }
                            console.log(response);
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Server Error !'
                            })
                            console.log(response);
                        }

                    })
                }
            })
        })
    </script>

</body>

</html>