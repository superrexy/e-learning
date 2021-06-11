<?php
session_start();

if(isset($_SESSION['status']) === true){
    header('Location: http://e-learning.test/dashboard');
    exit;
}

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
    <div>
        <p class="text-center h6 mb-3">Dosen Login</p>
        <div class="daftar mt-3">
            <p>Belum Mempunyai Akun ? <a href="http://e-learning.test/auth/register/?page=dosen">Daftar Disini</a></p>
        </div>
        <input type="text" class="d-none" id="dosen" name="dosen">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="login-btn d-flex justify-content-center">
            <button class="btn btn-primary btn-login">Login</button>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(".btn-login").click(function() {
                let username = $("#username").val();
                let password = $("#password").val();
                let dosen = $("#dosen").val();

                if (username.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Username Wajib Diisi !'
                    });
                } else if (password.length == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Password Wajib Diisi !'
                    });
                } else {
                    $.ajax({
                        url: "login.php",
                        type: "POST",
                        data: {
                            "dosen": dosen,
                            "username": username,
                            "password": password
                        },

                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Berhasil !',
                                    text: 'Anda akan di arahkan dalam 3 Detik',
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                }).then(function() {
                                    window.location = "http://localhost/e-learning/dashboard/";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Gagal !',
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
                            });

                            console.log(response);
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>