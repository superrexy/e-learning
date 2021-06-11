<?php
include '../config/koneksi.php';
session_start();
$id_kelas = $_GET['id'];
if ($_SESSION['status'] !== true) {
    header('Location: http://localhost/e-learning/auth/login/');
    exit;
}

$sqlKelas = "SELECT * FROM kelas WHERE id_kelas = $id_kelas";
$resultKelas = mysqli_query($conn, $sqlKelas);
$data = mysqli_fetch_assoc($resultKelas);


?>
<?php


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
            <a class="navbar-brand" href="http://localhost/e-learning/dashboard/">
                <img src="../assets/img/logo.svg" alt="SinauKuy">
            </a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto flex-row align-items-center profile">
                    <input type="hidden" class="id_mahasiswa" id="id_dosen" value="<?php echo $_SESSION['id']; ?>" />
                    <input type="hidden" name="id_kelas" id="id_kelas" value="<?php echo $id_kelas; ?>" />
                    <span class="nav-link" href="#"><img src="../assets/img/profile.png" alt="Profile" class="mx-3"><span>Hi, <?php echo $_SESSION['nama'] ?></span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="header bg-gradient-blue p-4 mt-3 rounded-15">
            <div class="information-class">
                <p class="text-white main-title"><?php echo $data['nama_kelas']; ?></p>
                <p class="text-white h5"><?php echo $data['desc_kelas']; ?></p>
                <p class="text-white mt-5">Token Kelas <strong><?php echo $data['token_kelas']; ?></strong></p>
            </div>
        </div>

        <div class="d-flex justify-content-end my-3">
            <?php if ($_SESSION['role'] == "dosen") : ?>
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#buatMateri">
                    Buat Materi Baru
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatTugas">
                    Buat Tugas Baru
                </button>
            <?php endif ?>

            <!-- Modal Buat Tugas -->
            <div class="modal fade" id="buatTugas" tabindex="-1" aria-labelledby="buatTugasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buatTugasLabel">Buat Tugas Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formBuatTugas">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Tugas</label>
                                    <input type="text" class="form-control" id="nama_tugas" name="nama_tugas">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Tugas</label>
                                    <textarea class="form-control" id="detail_tugas" name="detail_tugas" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Deadline Tugas</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline" min="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload File Tugas</label>
                                    <input class="form-control" type="file" id="file_tugas" name="file_tugas">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" id="submitTugas" class="btn btn-primary btn-tugas" data-bs-dismiss="modal" aria-label="Close">Tambah Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Buat Materi -->
            <div class="modal fade" id="buatMateri" tabindex="-1" aria-labelledby="buatMateriLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buatMateriLabel">Buat Materi Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formBuatMateri">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Materi</label>
                                    <input type="text" class="form-control" id="judul_materi" name="judul_materi">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Materi</label>
                                    <textarea class="form-control" id="isi_materi" name="isi_materi" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload File Materi</label>
                                    <input class="form-control" type="file" id="file_materi" name="file_materi">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" id="submitMateri" class="btn btn-primary btn-materi" data-bs-dismiss="modal" aria-label="Close">Tambah Materi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex">
            <div class="list-post col-8">
                <div class="materi">
                    <p class="h3">Materi</p>
                    <?php
                    $materi = "SELECT * FROM materi WHERE id_kelas = '$id_kelas'";
                    $resultsMateri = mysqli_query($conn, $materi);
                    $noMateri = 1;
                    ?>
                    <div class="materi-list">
                        <?php if (mysqli_num_rows($resultsMateri) == 0) : ?>
                            <p class="mb-5">Materi Masih Kosong</p>
                        <?php else : ?>
                            <?php foreach ($resultsMateri as $resultMateri) : ?>
                                <div class="card my-2">
                                    <button class="btn btn-detail-materi" type="button" data-bs-toggle="modal" data-bs-target="#modalMateri" data-get-target="<?php echo $resultMateri['id_materi']; ?>">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="../assets/img/materi.svg" alt="Materi" class="me-3">
                                            <p class="m-0 title-class"><strong>Materi <?php echo $noMateri;
                                                                                        $noMateri++ ?></strong> : <?php echo $resultMateri['judul_materi']; ?></p>
                                        </div>
                                    </button>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Modal Materi Detail -->
                <div class="modal fade" id="modalMateri" tabindex="-1" aria-labelledby="modalMateriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalMateriLabel">Materi <span class="judul-materi h5"></span></h5>
                                <?php if ($_SESSION['role'] == "dosen") : ?>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-secondary dropdown-toggle ms-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><button type="button" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#editMateriModal" class="dropdown-item btn-edit-materi-get" href="#">Edit Materi</butt>
                                            </li>
                                            <li><button type="button" class="dropdown-item btn-hapus-materi" data-bs-dismiss="modal" href="#">Hapus Materi</button></li>
                                        </ul>
                                    </div>
                                <?php endif ?>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="isi-materi mb-auto">

                                </div>
                                <div class="card card-materi mt-5 d-none">
                                    <div class="card-body d-flex align-items-center">
                                        <span class="iconify" data-icon="akar-icons:file" data-inline="false" style="font-size: 24px;"></span>
                                        <p class="m-0 mx-3 nama-file"></p>
                                        <a href="" class="ms-auto download-materi" target="_blank"><span class="iconify" data-icon="bi:cloud-download-fill" data-inline="false" style="font-size: 24px;"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Materi Edit -->
                <div class="modal fade" id="editMateriModal" tabindex="-1" aria-labelledby="editMateriModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buatMateriLabel">Edit Materi <span class="edit_judul_materi_span h5"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formEditMateri">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Materi</label>
                                        <input type="text" class="form-control" id="edit_judul_materi" name="edit_judul_materi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Materi</label>
                                        <textarea class="form-control" id="edit_isi_materi" name="edit_isi_materi" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Upload File Materi</label>
                                        <input class="form-control" type="file" id="edit_file_materi" name="edit_file_materi">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" id="editMateri" class="btn btn-primary btn-edit-materi" data-bs-dismiss="modal" aria-label="Close">Edit Materi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tugas mt-3">
                    <p class="h3">Tugas</p>
                    <?php
                    $tugas = "SELECT * FROM tugas WHERE id_kelas = '$id_kelas'";
                    $resultsTugas = mysqli_query($conn, $tugas);
                    $noTugas = 1;
                    ?>
                    <div class="tugas-list">
                        <?php if (mysqli_num_rows($resultsTugas) == 0) : ?>
                            <p class="mb-5">Tugas Masih Kosong</p>
                        <?php else : ?>
                            <?php foreach ($resultsTugas as $resultTugas) : ?>
                                <div class="card my-2">
                                    <button class="btn <?php echo ($_SESSION['role'] != "dosen") ? "btn-detail-tugas-mahasiswa" : "btn-detail-tugas-dosen" ?>" type="button" data-bs-toggle="modal" data-bs-target="#modalTugas" data-get-target="<?php echo $resultTugas['id_tugas']; ?>">
                                        <div class="card-body d-flex align-items-center">
                                            <img src="../assets/img/tasks.svg" alt="Tugas" class="me-3">
                                            <div class="desc-tugas">
                                                <p class="m-0 title-class text-start"><strong>Tugas <?php echo $noTugas;
                                                                                                    $noTugas++ ?></strong> : <?php echo $resultTugas['nama_tugas']; ?></p>
                                                <p class="m-0 text-start"><strong>Deadline </strong> : <?php echo date("l, d F Y", strtotime($resultTugas['deadline'])); ?></p>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Tugas -->
            <div class="modal fade" id="modalTugas" tabindex="-1" aria-labelledby="modalTugasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTugasLabel">Tugas <span class="judul-tugas h5"></span></h5>
                            <?php if ($_SESSION['role'] == "dosen") : ?>
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-secondary dropdown-toggle ms-2" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item btn-penilaian" href="#">Detail Pengumpulan</a></li>
                                        <li><button class="dropdown-item btn-detail-tugas-edit" href="#" data-bs-toggle="modal" data-bs-target="#editTugasModal" data-bs-dismiss="modal">Edit Tugas</button></li>
                                        <li><button class="dropdown-item btn-detail-tugas-hapus" data-bs-dismiss="modal" href="#">Hapus Tugas</button></li>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <div id="tempat_nilai" class="ms-2 w-25">
                                    <p class="m-0 text-center text-white nilai"></p>
                                </div>
                            <?php endif ?>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formUploadTugas" class="formUploadTugas">
                            <div class="modal-body">
                                <div class="isi-tugas mb-5">

                                </div>
                                <div class="card-tugas mt-5 d-none">
                                    <p for="formFile" class="form-label mt-2">File Tugas</p>
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center">
                                            <span class="iconify" data-icon="akar-icons:file" data-inline="false" style="font-size: 24px;"></span>
                                            <p class="m-0 mx-3 nama-file"></p>
                                            <a href="" class="ms-auto download-tugas" target="_blank"><span class="iconify" data-icon="bi:cloud-download-fill" data-inline="false" style="font-size: 24px;"></span></a>
                                        </div>
                                    </div>
                                </div>
                                <?php ?>
                                <?php if ($_SESSION['role'] != "dosen") : ?>
                                    <div class="upload-tugas mt-3 border-top">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label mt-2">Upload Tugas <span class="judul-tugas"></label>
                                            <input class="form-control" type="file" id="file_tugas_mahasiswa" name="file_tugas_mahasiswa">
                                            <p class="mt-3 m-0">Hati-Hati, Tugas Hanya Diperbolehkan Upload 1 Kali</p>
                                        </div>
                                    </div>

                                    <div class="border-top mt-2 card-tugas-mahasiswa d-none">
                                        <p for="formFile" class="form-label mt-2">Hasil Upload Tugas Mahasiswa</p>
                                        <div class="card mt-2">
                                            <div class="card-body d-flex align-items-center">
                                                <span class="iconify" data-icon="akar-icons:file" data-inline="false" style="font-size: 24px;"></span>
                                                <p class="m-0 mx-3 nama-tugas-mahasiswa-file"></p>
                                                <a href="" class="ms-auto download-tugas-mahasiswa" target="_blank"><span class="iconify" data-icon="bi:cloud-download-fill" data-inline="false" style="font-size: 24px;"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="modal-footer">
                                <p class="m-0 me-auto fw-bold">Deadline : <span class="deadline-tugas"></span></p>
                                <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" id="btnTugas" class="btn btn-primary <?php echo ($_SESSION['role'] != "dosen") ? "btn-upload-tugas" : "" ?>" data-bs-dismiss="modal">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Tugas -->
            <div class="modal fade" id="editTugasModal" tabindex="-1" aria-labelledby="editTugasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTugasLabel">Edit Tugas <span class="h5" id="edit_nama_tugas_span"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditTugas">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Tugas</label>
                                    <input type="text" class="form-control" id="edit_nama_tugas" name="edit_nama_tugas">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Tugas</label>
                                    <textarea class="form-control" id="edit_detail_tugas" name="edit_detail_tugas" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Deadline Tugas</label>
                                    <input type="date" class="form-control" id="edit_deadline" name="edit_deadline" min="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload File Tugas</label>
                                    <input class="form-control" type="file" id="edit_file_tugas" name="edit_file_tugas">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-tutup" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" id="editTugas" class="btn btn-primary btn-tugas-edit" data-bs-dismiss="modal" aria-label="Close">Edit Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="anggota-kelas col-4 ms-3">
                <?php
                $anggotaKelasSql = "SELECT kelas_detail.id_mahasiswa, id_kelas, nama FROM `kelas_detail` INNER JOIN mahasiswa ON kelas_detail.id_mahasiswa = mahasiswa.id_mahasiswa WHERE kelas_detail.id_kelas = $id_kelas";
                $resultsAnggota = mysqli_query($conn, $anggotaKelasSql);
                $noAnggota = 1;
                ?>
                <p class="h3">Anggota Kelas</p>
                <div class="anggota-list">
                    <div class="card">
                        <div class="card-body">
                            <?php if (mysqli_num_rows($resultsAnggota) == 0) : ?>
                                <div class="text-center h6 m-0">
                                    Anggota Masih Kosong
                                </div>
                            <?php else : ?>
                                <table>
                                    <?php foreach ($resultsAnggota as $resultAnggota) : ?>
                                        <div class="anggota-kelas d-flex align-items-center">
                                            <td>
                                                <p class="m-0 me-1 text-center"><?php echo $noAnggota;
                                                                                $noAnggota++; ?>. </p>
                                            </td>

                                            <td>
                                                <img src="../assets/img/profile.png" alt="Foto-Profile" width="60" class="me-1">
                                            </td>
                                            <td>
                                                <p class="m-0 me-1"><?php echo $resultAnggota['nama']; ?></p>
                                            </td>
                                            </tr>
                                        <?php endforeach ?>
                                </table>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
                // POST TUGAS NEW
                $("#submitTugas").click(function() {
                    const nama_tugas = $("input[name='nama_tugas']").val();
                    const detail_tugas = $("textarea[name='detail_tugas']").val();
                    const deadline = $("input[name='deadline']").val();
                    const file_tugas = $("input[name='file_tugas']").prop('files')[0];
                    const id_dosen = $("#id_dosen").val();
                    const id_kelas = $("#id_kelas").val();

                    let formDataTugas = new FormData($('#formBuatTugas')[0]);
                    formDataTugas.append('nama_tugas', nama_tugas);
                    formDataTugas.append('detail_tugas', detail_tugas);
                    formDataTugas.append('deadline', deadline);
                    formDataTugas.append('file_tugas', file_tugas);
                    formDataTugas.append('id_dosen', id_dosen);
                    formDataTugas.append('id_kelas', id_kelas);

                    if (nama_tugas.length == "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Nama Tugas Wajib Diisi !'
                        })
                    } else if (detail_tugas.length == "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Detail Tugas Wajib Diisi !'
                        })
                    } else if (deadline.length == "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Deadline Wajib Diisi !'
                        })
                    } else {
                        $.ajax({
                            url: "buat_tugas.php",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formDataTugas,

                            success: function(response) {
                                if (response == "success") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Tugas Berhasil Ditambahkan',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        location.reload();
                                    })

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Tugas Gagal Ditambahkan',
                                        text: 'Silahkan Coba Lagi !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }

                                console.log(response);
                            },

                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops !',
                                    text: 'Server Error !',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                console.log(response);
                            }
                        })
                    }

                })

                // POST Materi New
                $("#submitMateri").click(function() {
                    const judul_materi = $("input[name='judul_materi']").val();
                    const isi_materi = $("textarea[name='isi_materi']").val();
                    const file = $("input[name='file_materi']").prop('files')[0];
                    const id_kelas = $("#id_kelas").val();

                    let formDataMateri = new FormData($('#formBuatMateri')[0]);
                    formDataMateri.append('judul_materi', judul_materi);
                    formDataMateri.append('isi_materi', isi_materi);
                    formDataMateri.append('file', file);
                    formDataMateri.append('id_kelas', id_kelas);

                    if (judul_materi.length == "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Judul Materi Wajib Diisi !'
                        })
                    } else if (isi_materi.length == "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Isi Materi Wajib Diisi !'
                        })
                    } else {
                        $.ajax({
                            url: "buat_materi.php",
                            type: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formDataMateri,

                            success: function(response) {
                                if (response == "success") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Materi Berhasil Ditambahkan',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        location.reload();
                                    })

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Materi Gagal Ditambahkan',
                                        text: 'Silahkan Coba Lagi !',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }

                                console.log(response);
                            },

                            error: function(response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops !',
                                    text: 'Server Error !',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                console.log(response);
                            }
                        })
                    }

                })
            },

            // Get Detail Materi
            $('.btn-detail-materi').click(function() {
                let id_materi = $(this).attr('data-get-target');
                localStorage.setItem('id_materi', id_materi);

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_materi.php?id=${id_materi}`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).done(function(data) {
                    $('.judul-materi').text(data.data[0].judul_materi);
                    $('.isi-materi').text(data.data[0].isi_materi);
                    $('.nama-file').text(data.data[0].name_file);
                    if (data.data[0].file != "") {
                        let newurl = `http://localhost/e-learning/assets/${data.data[0].file}`
                        $('.download-materi').attr('href', newurl);
                        $('.card-materi').removeClass("d-none");
                    } else {
                        $('.card-materi').addClass("d-none");
                    }
                })
            }),

            // Get Detail Tugas
            $('.btn-detail-tugas-dosen').click(function() {
                let id_tugas = $(this).attr('data-get-target');
                let id_kelas = $('#id_kelas').val();
                localStorage.setItem('id_tugas', id_tugas);

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_tugas.php?id=${id_tugas}`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).done(function(data) {
                    $('.judul-tugas').text(data.data[0].nama_tugas);
                    $('.isi-tugas').text(data.data[0].detail_tugas);
                    $('.deadline-tugas').text(data.data[0].deadline_format);
                    $('.nama-file').text(data.data[0].name_file);
                    let urlpengumpulan = `http://localhost/e-learning/dashboard/tugas.php?kelas=${id_kelas}&tugas=${id_tugas}`;
                    $('.btn-penilaian').attr('href', urlpengumpulan);
                    if (data.data[0].file !== "") {
                        let newurl = `http://localhost/e-learning/assets/${data.data[0].file}`
                        $('.download-tugas').attr('href', newurl);
                        $('.card-tugas').removeClass("d-none");
                    } else {
                        $('.card-tugas').addClass("d-none");
                    }
                })
            }),

            // Edit Detail Tugas
            $('.btn-detail-tugas-edit').click(function() {
                let id_tugas = localStorage.getItem('id_tugas');

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_tugas.php`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    data: {
                        "id": id_tugas
                    },
                }).done(function(data) {
                    $('#edit_nama_tugas').val(data.data[0].nama_tugas);
                    $('#edit_nama_tugas_span').text(data.data[0].nama_tugas);
                    $('#edit_detail_tugas').val(data.data[0].detail_tugas);
                    $('#edit_deadline').val(data.data[0].deadline);
                })
            }),

            $("#editTugas").click(function() {
                const edit_nama_tugas = $("input[name='edit_nama_tugas']").val();
                const edit_detail_tugas = $("textarea[name='edit_detail_tugas']").val();
                const edit_deadline = $("input[name='edit_deadline']").val();
                const edit_file_tugas = $("input[name='edit_file_tugas']").prop('files')[0];
                const id_tugas = localStorage.getItem('id_tugas');

                let formDataEditTugas = new FormData($('#formEditTugas')[0]);
                formDataEditTugas.append('nama_tugas', edit_nama_tugas);
                formDataEditTugas.append('detail_tugas', edit_detail_tugas);
                formDataEditTugas.append('deadline', edit_deadline);
                formDataEditTugas.append('file_tugas', edit_file_tugas);
                formDataEditTugas.append('id_tugas', id_tugas);

                if (edit_nama_tugas.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nama Tugas Wajib Diisi !'
                    })
                } else if (edit_detail_tugas.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Detail Tugas Wajib Diisi !'
                    })
                } else if (deadline.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Deadline Kelas Wajib Diisi !'
                    })
                } else {
                    $.ajax({
                        url: "edit_tugas.php",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formDataEditTugas,

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Tugas Berhasil Diedit !',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                })

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tugas Gagal Diedit !',
                                    text: 'Silahkan Coba Lagi !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                            console.log(response);
                        },

                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops !',
                                text: 'Server Error !',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            console.log(response);
                        }
                    })
                }
            }),

            // Hapus Tugas
            $('.btn-detail-tugas-hapus').click(function() {
                const id_tugas = localStorage.getItem('id_tugas');

                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin Akan Menghapus Materi?',
                    showDenyButton: true,
                    confirmButtonText: `OK`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Materi Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $.ajax({
                                url: "delete_tugas.php",
                                type: "GET",
                                data: {
                                    "id": id_tugas,
                                },

                                success: function(response) {
                                    console.log(response);
                                },

                                error: function(response) {
                                    console.log(response);
                                }
                            }).then(function() {
                                location.reload();
                            })

                        })
                    } else if (result.isDenied) {
                        Swal.fire('Materi Tidak Di Hapus!', '', 'info').then(function() {
                            location.reload();
                        })
                    }
                })
            }),

            // Edit Materi

            $('.btn-edit-materi-get').click(function() {
                let id_materi = localStorage.getItem('id_materi');

                console.log(id_materi);

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_materi.php?id=${id_materi}`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).done(function(data) {
                    $("input[name='edit_judul_materi']").val(data.data[0].judul_materi);
                    $(".edit_judul_materi_span").text(data.data[0].judul_materi);
                    $("textarea[name='edit_isi_materi']").val(data.data[0].isi_materi);
                    $("input[name='edit_file']").val(data.data[0].file);
                })
            }),

            $('#editMateri').click(function() {
                const edit_judul_materi = $("input[name='edit_judul_materi']").val();
                const edit_isi_materi = $("textarea[name='edit_isi_materi']").val();
                const edit_file_materi = $("input[name='edit_file_materi']").prop('files')[0];
                const id_materi = localStorage.getItem('id_materi');

                let formDataEditMateri = new FormData($('#formEditMateri')[0]);
                formDataEditMateri.append('judul_materi', edit_judul_materi);
                formDataEditMateri.append('isi_materi', edit_isi_materi);
                formDataEditMateri.append('file_materi', edit_file_materi);
                formDataEditMateri.append('id_materi', id_materi);

                if (edit_judul_materi.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Judul Materi Wajib Diisi !',
                    })
                } else if (edit_isi_materi.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Isi Materi Wajib Diisi !',
                    })
                } else {
                    $.ajax({
                        url: "edit_materi.php",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formDataEditMateri,

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Materi Berhasil Diedit',
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(function() {
                                    location.reload();
                                })

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Materi Gagal Diedit',
                                    text: 'Silahkan Coba Lagi !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }

                            console.log(response);
                        },

                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops !',
                                text: 'Server Error !',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            console.log(response);
                        },
                    })
                }

            }),

            // Delete Materi
            $('.btn-hapus-materi').click(function() {
                const id_materi = localStorage.getItem('id_materi');

                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin Akan Menghapus Materi?',
                    showDenyButton: true,
                    confirmButtonText: `OK`,
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Materi Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $.ajax({
                                url: "delete_materi.php",
                                type: "GET",
                                data: {
                                    "id": id_materi,
                                },

                                success: function(response) {
                                    console.log(response);
                                },

                                error: function(response) {
                                    console.log(response);
                                }
                            }).then(function() {
                                location.reload();
                            })

                        })
                    } else if (result.isDenied) {
                        Swal.fire('Materi Tidak Di Hapus!', '', 'info').then(function() {
                            location.reload();
                        })
                    }
                })
            }),

            // Upload Tugas Role Mahasiswa
            $('.btn-upload-tugas').click(function() {
                const id_mahasiswa = $(".id_mahasiswa").val();
                const id_tugas = localStorage.getItem('id_tugas');
                const id_kelas = $("#id_kelas").val();
                const file_tugas_mahasiswa = $("input[name='file_tugas_mahasiswa']").prop('files')[0];
                const file_tugas_mhs = $("input[name='file_tugas_mahasiswa']").val();

                let formDataTugasMahasiswa = new FormData($('#formUploadTugas')[0]);
                formDataTugasMahasiswa.append('id_mahasiswa', id_mahasiswa);
                formDataTugasMahasiswa.append('id_tugas', id_tugas);
                formDataTugasMahasiswa.append('id_kelas', id_kelas);
                formDataTugasMahasiswa.append('file_tugas_mahasiswa', file_tugas_mahasiswa);

                if (file_tugas_mhs.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Silahkan Upload Tugas Anda !'
                    })
                } else {
                    $.ajax({
                        url: "upload_tugas_mahasiswa.php",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formDataTugasMahasiswa,

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Tugas Berhasil Diupload',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    location.reload();
                                })
                            } else if (response == "Duplikasi Data") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tugas Gagal Diupload',
                                    text: 'Terdapat Duplikasi Data !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tugas Gagal Diupload',
                                    text: 'Silahkan Coba Lagi !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            console.log(response);
                        },

                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops !',
                                text: 'Server Error !',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            console.log(response);
                        }
                    })
                }

            }),

            // GET DETAIL TUGAS ROLE MAHASISWA
            $('.btn-detail-tugas-mahasiswa').click(function() {
                let id_mahasiswa = $(".id_mahasiswa").val();
                let id_tugas = $(this).attr('data-get-target');
                localStorage.setItem('id_tugas', id_tugas);

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_tugas.php?id=${id_tugas}`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    }

                }).done(function(data) {
                    $('.judul-tugas').text(data.data[0].nama_tugas);
                    $('.isi-tugas').text(data.data[0].detail_tugas);
                    $('.deadline-tugas').text(data.data[0].deadline_format);
                    $('.nama-file').text(data.data[0].name_file);
                    if (data.data[0].file !== "") {
                        let newurl = `http://localhost/e-learning/assets/${data.data[0].file}`
                        $('.download-tugas').attr('href', newurl);
                        $('.card-tugas').removeClass("d-none");
                    } else {
                        $('.card-tugas').addClass("d-none");
                    }
                })

                $.ajax({
                    type: 'GET',
                    url: `http://localhost/e-learning/dashboard/detail_tugas_mahasiswa.php`,
                    dataType: 'json',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    data: {
                        "id_mahasiswa": id_mahasiswa,
                        "id_tugas": id_tugas
                    }
                }).done(function(data) {
                    $(".nama-tugas-mahasiswa-file").text(data.data[0].name_file);
                    if (data.data[0].message != "null") {
                        let urlfiletugas = `http://localhost/e-learning/assets/${data.data[0].file}`
                        $('.download-tugas-mahasiswa').attr('href', urlfiletugas);
                        $('.upload-tugas').addClass('d-none');
                        $('.card-tugas-mahasiswa').removeClass('d-none');
                        $('#btnTugas').addClass('d-none');
                    } else {
                        $('.card-tugas').addClass("d-none");
                        $('.upload-tugas').removeClass('d-none');
                        $('.card-tugas-mahasiswa').addClass('d-none');
                        $('#btnTugas').removeClass('d-none');
                    }

                    if (data.data[0].nilai == null) {
                        $('#tempat_nilai').addClass('d-none');
                    } else {
                        $('#tempat_nilai').removeClass('d-none');
                        if (data.data[0].nilai >= 75) {
                            $('.nilai').text("100 / " + data.data[0].nilai);
                            $('#tempat_nilai').addClass('bg-success');
                            $('#tempat_nilai').removeClass('bg-danger');
                        } else {
                            $('.nilai').text("100 / " + data.data[0].nilai);
                            $('#tempat_nilai').removeClass('bg-success');
                            $('#tempat_nilai').addClass('bg-danger');
                        }
                    }
                })
            })

        )
    </script>

</body>

</html>