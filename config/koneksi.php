<?php 

$servername = "localhost";
$database = "techgear_db";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Koneksi gagal: ". mysqli_connect_error());
};

if (!defined("ROOT_URL")) {
    define("ROOT_URL", "/projek-uas/");
}


// echo "Berhasil koneksi"

?>