<?php
require '../config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['pass']) && $_POST['pass'] != ""){
    $password = $_POST['pass'];
    $id = $_POST['idUser'];
    $conn->query("UPDATE `user` SET `password`='$password' WHERE id_user = '$id'");
    $response = "Berhasil Reset Password Siswa";
    http_response_code(200);
  }else if($_POST['idUser'] != "" && $_POST['nmGuru'] != "" && $_POST['username'] != "" && $_POST['password'] != ""){
    var_dump($_POST);
    $id_user = $_POST['idUser'];
    $nm_guru = $_POST['nmGuru'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn->query("INSERT INTO `guru`(`id_user`, `nm_guru`) VALUES ('$id_user', '$nm_guru');");
    $conn->query("INSERT INTO `user`(`id_user`, `username`, `password`, `level`) VALUES ('$id_user','$username','$password','2');");
    $response = "Berhasil Tambah Kelas";
    http_response_code(200);
  }else{
    $response = "Inputan Wajib Di isi";
    http_response_code(400);
  }
  echo $response;
}else if($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $_PUT = json_decode(file_get_contents('php://input'), true);
  if($_PUT['masukTahun'] == "" || $_PUT['tahunLulus'] == "" || $_PUT['nmSiswa'] == ""){
    $response = "Data Siswa Wajib Di isi";
    http_response_code(400);
  }else{
    $id = $_PUT["idUser"];
    $masuk_tahun = $_PUT["masukTahun"];
    $tahun_lulus = $_PUT["tahunLulus"];
    $nm_siswa = $_PUT["nmSiswa"];
    $conn->query("UPDATE `siswa` SET `nm_siswa`='$nm_siswa',`masuk_tahun`=$masuk_tahun,`lulus_tahun`=$tahun_lulus WHERE id_user = $id");
    $response = json_encode([
      'message' => "succes update siswa",
    ]);
    http_response_code(200);
  }
  echo $response;
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $_DELETE = json_decode(file_get_contents('php://input'), true);
  $id = $_DELETE['idUser'];
  $response = [
    'message' => "succes delete kelas",
  ];
  $conn->query("DELETE FROM user WHERE id_user = $id;");
  $conn->query("DELETE FROM guru WHERE id_user = $id;");

  http_response_code(200);
  echo json_encode($response);
}
?>