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
    <link rel="shortcut icon" href="../../assets/img/icon.svg">
    <title>Virtual E-Learning</title>

    <!-- My CSS -->
    <link rel="stylesheet" href="../../assets/css/main.css">

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
            <span class="navbar-brand">
                <img src="../../assets/img/logo.svg" alt="SinauKuy">
            </span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="wrapper-select">
            <div class="login-select">
                <div class="btn-kembali mb-5 ms-3 d-none d-flex align-self-start align-content-center align-items-center">
                    <a><span class="iconify" data-inline="false" data-icon="ant-design:left-outlined" style="font-size: 24px;"></span>
                        <span>Kembali Ke Pilihan</span>
                    </a>
                </div>
                <div class="bg-cover">
                    <img src="../../assets/img/icon.svg" alt="Virtual E-Learning" class="d-flex mx-auto">
                    <p class="h4">Virtual E-Learning</p>
                </div>
                <div class="button-select mt-5">
                    <p class="h6 text-center">Login Sebagai</p>
                    <button type="button" class="btn btn-primary" id="mahasiswa">Mahasiswa</button>
                    <button type="button" class="btn btn-primary" id="dosen">Dosen</button>
                </div>
                <div class="main-login d-none mt-4">

                </div>
            </div>
        </div>

    </div>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn').click(function() {
            var menu = $(this).attr('id');
            if (menu == "mahasiswa") {
                $(".button-select").addClass("d-none");
                $('.main-login').load('login_mahasiswa.php');
                $(".main-login").removeClass("d-none");
                $(".btn-kembali").removeClass("d-none");
            } else if (menu == "dosen") {
                $(".button-select").addClass("d-none");
                $('.main-login').load('login_dosen.php');
                $(".main-login").removeClass("d-none");
                $(".btn-kembali").removeClass("d-none");
            }
        });
        // halaman yang di load default pertama kali
        $('.badan').load('index.php');

        $('.btn-kembali').click(function() {
            $(".button-select").removeClass("d-none");
            $(".main-login").addClass("d-none");
            $(".btn-kembali").addClass("d-none");
        })

    });
</script>

</html>