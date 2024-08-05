<?php
$env = parse_ini_file('.env');
$host = $env['HOST'];
$username = $env['USERNAME'];
$password = $env['PASSWORD'];
$dbname = $env['DB_NAME'];

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";

function url($url){
    global $env;
    return $env['BASE_URL'].$url;
}
?>
