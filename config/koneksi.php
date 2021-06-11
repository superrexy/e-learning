<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_e-learning";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn){
    die('Koneksi Gagal ' . mysqli_connect_error());
}

?>