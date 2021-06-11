<?php
include '../config/koneksi.php';
if ($_SESSION['status'] !== true) {
    header('Location: http://localhost/e-learning/auth/login/');
    exit;
}

$sql = "SELECT kelas_detail.id_mahasiswa, kelas.id_kelas, nama_kelas, dosen.nama FROM `kelas` INNER JOIN kelas_detail ON kelas.id_kelas = kelas_detail.id_kelas INNER JOIN dosen ON kelas.id_dosen = dosen.id_dosen WHERE id_mahasiswa = $_SESSION[id]";
$results = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/icon.svg">
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
    <div class="container-fluid">
        <div class="courses">
            <div class="title d-flex align-items-center">
                <p class="main-title">Courses</p>
                <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="<?php echo $_SESSION['id']; ?>" />
                <button type="button" class="btn btn-primary ms-auto me-3" data-bs-toggle="modal" data-bs-target="#gabungKelas">
                    Gabung Kelas
                </button>

                <!-- Modal Gabung Kelas-->
                <div class="modal fade" id="gabungKelas" tabindex="-1" aria-labelledby="gabungKelasLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gabungKelasLabel">Gabung Kelas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label me-3">Token Kelas</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="token_kelas" name="token_kelas">
                                    </div>
                                </div>
                                <span>Token dapat didapatkan dari Dosen Pengajar</span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary btn-gabung-kelas" data-bs-dismiss="modal">Gabung Kelas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="courses-list d-flex flex-wrap ">
                <?php if (mysqli_num_rows($results) == 0) : ?>
                    <p>Kelas Masih Kosong</p>
                <?php else : ?>
                    <?php foreach ($results as $result) : ?>
                        <div class="wrapper-courses">
                            <a href="kelas.php?id=<?php echo $result['id_kelas']; ?>" class="text-decoration-none">
                                <div class="detail-course bg-gradient-blue">
                                    <p class="h5 text-white"><?php echo $result['nama_kelas']; ?></p>
                                    <p class="text-white"><?php echo $result['nama']; ?></p>
                                </div>
                            </a>
                            <div class="detail-task">

                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>

    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('.btn-gabung-kelas').click(function() {
                $token_kelas = $("input[name='token_kelas']").val();
                $id_mahasiswa = $("#id_mahasiswa").val();

                if ($token_kelas.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Token Kelas Wajib Diisi !'
                    })
                } else {
                    $.ajax({
                        url: "http://localhost/e-learning/dashboard/join_kelas.php",
                        type: "POST",
                        data: {
                            "token_kelas": $token_kelas,
                            "id_mahasiswa": $id_mahasiswa,
                        },

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Gabung Kelas Berhasil !',
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(function() {
                                    location.reload();
                                })

                            } else if (response == "Duplikasi Data") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Sudah Tergabung Dalam Kelas !'
                                })
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: 'Token Kelas Salah !'
                                })
                            }
                            console.log(response);
                        },

                        error: function(response) {
                            Swal.fire({
                                icon: 'warning',
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