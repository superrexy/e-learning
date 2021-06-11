<?php
include '../config/koneksi.php';
if ($_SESSION['status'] !== true) {
    header('Location: http://localhost/e-learning/auth/login/');
    exit;
}

$sql = "SELECT * FROM kelas WHERE id_dosen = '$_SESSION[id]'";
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ms-auto me-3" data-bs-toggle="modal" data-bs-target="#tambahKelas">
                    Buat Kelas Baru
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahKelasLabel">Buat Kelas Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" name="nama_kelas">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Deskripsi Kelas</label>
                                <input type="text" class="form-control" name="desc_kelas">
                            </div>
                            <fieldset disabled>
                                <input type="text" id="id_dosen" name="id_dosen" class="form-control d-none" placeholder="Disabled input" value="<?php echo $_SESSION['id']; ?>">
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary btn-buat-kelas" data-bs-dismiss="modal" aria-label="Close">Buat Kelas</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses List -->
            <?php if (mysqli_num_rows($results) == 0): ?>
                <p class="h5 mt-3">Data Kelas Masih Kosong</p>
            <?php else: ?>
                <div class="courses-list d-flex flex-wrap ">
                    <?php foreach($results as $result): ?>
                        <div class="wrapper-courses">
                            <a href="kelas.php?id=<?php echo $result['id_kelas']; ?>" class="text-decoration-none">
                                <div class="detail-course bg-gradient-blue">
                                    <p class="h5 text-white"><?php echo $result['nama_kelas']; ?></p>
                                    <p class="text-white"><?php echo $result['desc_kelas']; ?></p>
                                </div>
                            </a>
                            <div class="detail-task">

                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(".btn-buat-kelas").click(function() {
                let nama_kelas = $("input[name='nama_kelas']").val();
                let desc_kelas = $("input[name='desc_kelas']").val();
                let id_dosen = $("input[name='id_dosen']").val();
                let token_kelas = function() {
                    return Math.random().toString(32).substr(7);
                }

                if (nama_kelas.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Nama Kelas Wajib Diisi !'
                    })
                } else if (desc_kelas.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Deskripsi Kelas Wajib Diisi !'
                    })
                } else {
                    $.ajax({
                        url: "buat_kelas.php",
                        type: "POST",
                        data: {
                            "nama_kelas": nama_kelas,
                            "desc_kelas": desc_kelas,
                            "token_kelas": token_kelas(),
                            "id_dosen": id_dosen
                        },


                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Buat Kelas Berhasil !',
                                }).then(function() {
                                    location.reload();
                                })

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Membuat Kelas Gagal !',
                                    text: 'Silahkan Coba Lagi !'
                                });
                            }

                            console.log(response);
                        },

                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops !',
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