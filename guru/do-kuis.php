<?php
require '../config.php';
session_start();
$id_guru = $_SESSION['uid'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if(isset($_POST['PUT'])){
        $id = $_POST['PUT'];
        $id_mp = $_POST['id_dtl'];
        $no = $_POST['no'];
        $nm_tugas = $_POST['nm_tugas'];
        $dtl_tugas = $_POST['dtl_tugas'];
        $mulai_date = $_POST['mulai_date'];
        $mulai_time = $_POST['mulai_time'];
        $mulai = $mulai_date." ".$mulai_time;
        $selesai_date = $_POST['selesai_date'];
        $selesai_time = $_POST['selesai_time'];
        $selesai = $selesai_date." ".$selesai_time;
        $conn->query("");
    }else{
        $id_mp = $_POST['id_dtl'];
        $no = $_POST['no'];
        $nm_tugas = $_POST['nm_tugas'];
        $dtl_tugas = $_POST['dtl_tugas'];
        $mulai_date = $_POST['mulai_date'];
        $mulai_time = $_POST['mulai_time'];
        $mulai = $mulai_date." ".$mulai_time;
        $selesai_date = $_POST['selesai_date'];
        $selesai_time = $_POST['selesai_time'];
        $selesai = $selesai_date." ".$selesai_time;
        $conn->query("");
    }
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    $id = $_DELETE['idTugas'];
    $conn->query("DELETE FROM tbtugas WHERE id_tugas = $id;");
    $conn->query("DELETE FROM tbtugasdtl WHERE id_tugas = $id;");
}else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $_PUT = json_decode(file_get_contents('php://input'), true);
    $id = $_PUT['idJawab'];
    $nilai = $_PUT['nilai'];
    $conn->query("UPDATE `tbtugasjawab` SET `status`='3',`nilai`='$nilai' WHERE id_tugasjawab = '$id'");
}

?>