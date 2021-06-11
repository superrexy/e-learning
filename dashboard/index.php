<?php
session_start();

if ($_SESSION['status'] !== true) {
    header('Location: http://localhost/e-learning/auth/login/');
    exit;
}

if (isset($_GET['page']) == null) {
    $_GET['page'] = 'home';
} else {
    $_GET['page'];
}
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
                    <span class="nav-link" href="#"><img src="../assets/img/profile.png" alt="Profile" class="mx-1"><span>Hi, <?php echo $_SESSION['nama'] ?></span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar position-absolute top-0 start-0">
        <ul class="nav flex-column align-content-center px-3">
            <a class="navbar-brand" href="http://localhost/e-learning/dashboard">
                <img src="../assets/img/logo.svg" alt="SinauKuy">
            </a>
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET["page"] == 'home') ? 'active' : ' '; ?>" href="index.php?page=home"><span class="iconify me-4" style="font-size: 24px;" data-inline="false" data-icon="ant-design:home-filled"></span>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php"><span class="iconify me-4" data-inline="false" data-icon="bx:bx-log-out" style="font-size: 24px;"></span>Log Out</a>
            </li>
        </ul>
    </div>

    <div class="main-content">

        <?php
        if ($_SESSION['role'] === "dosen") {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                switch ($page) {
                    case 'home':
                        include "../pages/home_dosen.php";
                        break;
                    default:
                        include "../404.php";
                        break;
                }
            } else {
                include "../pages/home_dosen.php";
            }
        } else {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                switch ($page) {
                    case 'home':
                        include "../pages/home_mahasiswa.php";
                        break;
                    default:
                        include "../404.php";
                        break;
                }
            } else {
                include "../pages/home_mahasiswa.php";
            }
        }


        ?>
    </div>

</body>

</html>