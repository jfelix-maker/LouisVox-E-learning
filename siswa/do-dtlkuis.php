<?php
require '../config.php';
session_start();
$id_guru = $_SESSION['uid'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_SESSION['level'] == 3 && isset($_SESSION['jawab'])){
      $jawab = $_SESSION['jawab'];
      $jb = $_POST['jawab'];
      $no = $_POST['no'];
      $jawab['jawab'][$no] = true;
      $_SESSION['jawab']['jawab'][$no] = true;
      echo json_encode(['hasil' => true, 'jawab' => $jawab['jawab']]);
    }
}else if($_SERVER['REQUEST_METHOD'] === 'GET') {
  $jawab = $_SESSION['jawab'];
  echo json_encode(['jawab' => $jawab['jawab']]);
}
?>