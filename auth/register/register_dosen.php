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
    <div class="title">
        <img src="../../assets/img/icon.svg" alt="Virtual E-Learning" class="d-flex mx-auto">
        <p class="h6 text-center">Virtual E-Learning</p>
        <p class="text-center mt-4 h6">Daftar Akun Dosen</p>
        <p class="text-center">Sudah Punya Akun ? <a href="http://e-learning.test/auth/login/">Login Disini</a></p>
    </div>
    <div class="row g-3">
        <input type="text" name="dosen" class="d-none">
        <div class="col-12">
            <label for="inputAddress" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" maxlength="15">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-primary btn-daftar">Daftar</button>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btn-daftar").click(function() {
                let nip = $("input[name='nip']").val();
                let nama = $("input[name='nama']").val();
                let username = $("input[name='username']").val();
                let password = $("input[name='password']").val();
                let dosen = $("input[name='dosen']").val();

                if (nip.length == "") {
                    swal("Oops!", "NIP Wajib Diisi !", "error");
                } else if (nama.length == "") {
                    swal("Oops!", "Nama Lengkap Wajib Diisi !", "error");
                } else if (username.length == "") {
                    swal("Oops!", "Username Wajib Diisi !", "error");
                } else if (password.length == "") {
                    swal("Oops!", "Password Wajib Diisi !", "error");
                } else {
                    $.ajax({
                        url: "register.php",
                        type: "POST",
                        data: {
                            "dosen": dosen,
                            "nip": nip,
                            "nama": nama,
                            "username": username,
                            "password": password,
                        },

                        success: function(response) {
                            if (response == "success") {
                                swal("Register Berhasil !", "Silahkan Login !", "success").then(function() {
                                    window.location = "http://localhost/e-learning/auth/login/";
                                });

                                $("input[name='nip']").val('');
                                $("input[name='nama']").val('');
                                $("input[name='username']").val('');
                                $("input[name='password']").val('');
                            } else {
                                swal("Register Gagal!", "Silahkan Coba Lagi !", "error");
                            }
                            console.log(response);
                        },

                        error: function(response) {
                            swal("Opps!", "Server Error !", "error");
                        }
                    })
                }
            })
        })
    </script>

</body>




</html>