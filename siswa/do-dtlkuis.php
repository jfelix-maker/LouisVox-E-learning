<?php
require '../config.php';
session_start();
$id_guru = $_SESSION['uid'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_SESSION['level'] == 3 && isset($_SESSION['jawab'])){
      $id_siswa = $_SESSION['uid'];
      $id_kuis = $_SESSION['jawab']['id'];
      $jawab = $_SESSION['jawab']['jawab'];
      $jb = $_POST['jawab'];
      $no = $_POST['no'];
      $jawab[$no] = $jb;
      if(isset($_SESSION['jawab']['jawab'][$no])){
        http_response_code(400);
      }else{
        $_SESSION['jawab']['jawab'][$no] = $jb;
        $cek = $conn->query("SELECT * FROM tbkuisdtl WHERE id_kuis = '$id_kuis' AND no = '$no' AND kunci = '$jb';")->num_rows;
        echo json_encode(['hasil' => $cek, 'jawab' => $jawab]);
      }
    }
}else if($_SERVER['REQUEST_METHOD'] === 'GET') {
  $jawab = $_SESSION['jawab'];
  echo json_encode(['jawab' => $jawab['jawab']]);
}
?>