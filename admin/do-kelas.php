<?php
require '../config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(isset($_POST['namaKelas']) && $_POST['namaKelas'] != ""){
    $nm_kelas = $_POST['namaKelas'];
    $conn->query("INSERT INTO tbkelas(nm_kelas) VALUES ('$nm_kelas')");
    $response = "Berhasil Tambah Kelas";
    http_response_code(200);
  }else{
    $response = "Nama Kelas Wajib Di isi";
    http_response_code(400);
  }

  
  echo $response;
}else if($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $_PUT = json_decode(file_get_contents('php://input'), true);
  $nm_kelas = $_PUT['namaKelas'];
  $id_kelas = $_PUT['idKelas'];
  $conn->query("UPDATE tbkelas SET nm_kelas='$nm_kelas' WHERE id_kelas = '$id_kelas'");
  $response = [
    'message' => "succes update kelas",
  ];
  http_response_code(200);
  // header('Content-Type: application/json');
  echo json_encode($response);
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $_DELETE = json_decode(file_get_contents('php://input'), true);
  $id_kelas = $_DELETE['idKelas'];
  $response = [
    'message' => "succes delete kelas",
  ];
  $conn->query("DELETE tbsiswa FROM tbuser JOIN tbsiswa ON tbuser.id_user = tbsiswa.id_user WHERE tbsiswa.id_kelas = $id_kelas;");
  $conn->query("DELETE FROM tbkelas WHERE id_kelas = $id_kelas;");
  http_response_code(200);
  echo json_encode($response);
}
?>