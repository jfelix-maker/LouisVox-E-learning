<?php
require '../config.php';
session_start();
$id_guru = $_SESSION['uid'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dok = basename($_FILES["dok"]["name"]); 
    $new_dok = time();
    $dir = "../assets/tugas/". $new_dok . ".pdf";
    $save_dir = url("/assets/tugas/". $new_dok . ".pdf");
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
        if ($_FILES["dok"]["size"] == 0) {
            $conn->query("UPDATE `tbtugas` SET `no`='$no' WHERE id_tugas = '$id'");
            $conn->query("UPDATE `tbtugasdtl` SET `nm_tugas`='$nm_tugas',`dtl_tugas`='$dtl_tugas',`mulai`='$mulai',`selesai`='$selesai' WHERE id_tugas = '$id'");
            header("Location: ".url("/guru/tugas.php?kl=".$id_mp));
            exit;
        }else if(move_uploaded_file($_FILES["dok"]["tmp_name"], $dir)){
            $conn->query("UPDATE `tbtugas` SET `no`='$no' WHERE id_tugas = '$id'");
            $conn->query("UPDATE `tbtugasdtl` SET `nm_tugas`='$nm_tugas',`dtl_tugas`='$dtl_tugas',`dokumen`='$save_dir',`mulai`='$mulai',`selesai`='$selesai' WHERE id_tugas = '$id'");
            header("Location: ".url("/guru/tugas.php?kl=".$id_mp));
            exit;
        }
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
        if ($_FILES["dok"]["size"] == 0) {
            echo "empty";
            header("Location: ".url("/guru/materi.php?kd=".$id_mp));
            exit;
        }else if(move_uploaded_file($_FILES["dok"]["tmp_name"], $dir)){
            $conn->query("INSERT INTO `tbtugas`(`id_mapel_dtl`, `no`) VALUES ('$id_mp','$no')");
            $conn->query("INSERT INTO `tbtugasdtl`(`id_tugas`, `nm_tugas`, `dtl_tugas`, `dokumen`, `mulai`, `selesai`) VALUES ((SELECT id_tugas FROM tbtugas  ORDER BY id_tugas DESC LIMIT 1),'$nm_tugas','$dtl_tugas','$save_dir','$mulai','$selesai')");
            header("Location: ".url("/guru/tugas.php?kl=".$id_mp));
            exit;
        }
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