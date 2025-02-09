<?php
$env = parse_ini_file('.env');
$host = "127.0.0.1:3306";
$mysql_username = "sekolah";
$mysql_password = "123";
$dbname = "sekolah";

// Fungsi untuk generate OTP
function generateOtp() {
    return rand(100000, 999999); // Menghasilkan OTP 6 digit acak
}

$conn = new mysqli($host, $mysql_username, $mysql_password, $dbname);

date_default_timezone_set('Asia/Jakarta');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";

function url($url){
    global $env;
    return $env['BASE_URL'].$url;
}
function tahun_ajar($tahun_ajaran = 0){
    if($tahun_ajaran == 0){
        return "";
    }
    $th = explode(".",$tahun_ajaran);
    $semester = ($th["1"] > 1 ? " Genap" : " Ganjil");
    return $th[0].$semester;
}
function tanggal($date) {
    $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
    $raw = explode(' ', $date);
    $clean = explode('-', $raw[0]);
    $year = $clean[0];
    $month = $months[$clean[1]];
    $day = $clean[2];
    return $day . ' ' . $month . ' ' . $year.' '.$raw[1];
}
?>
