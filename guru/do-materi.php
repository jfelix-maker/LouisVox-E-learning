<?php
require '../config.php';
session_start();
$id_guru = $_SESSION['uid'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dok = basename($_FILES["dok"]["name"]); 
    $new_dok = time();
    $dir = "../assets/materi/". $new_dok . ".pdf";
    if(isset($_POST['PUT'])){
        $id = $_POST['PUT'];
        $id_kelas = $_POST['id_kelas'];
        $nm_materi = $_POST['nm_materi'];
        if ($_FILES["dok"]["size"] == 0) {
            $conn->query("UPDATE `tbmateri` SET `nm_materi`='$nm_materi' WHERE id_materi = '$id'");
            header("Location: ".url("/guru/materi.php?kl=".$id_kelas));
            exit;
        }else if(move_uploaded_file($_FILES["dok"]["tmp_name"], $dir)){
            $conn->query("UPDATE `tbmateri` SET `nm_materi`='$nm_materi',`dokumen`='$dir' WHERE id_materi = '$id'");
            header("Location: ".url("/guru/materi.php?kl=".$id_kelas));
            exit;
        }
    }else{
        $nm_materi = $_POST['nm_materi'];
        $id_kelas = $_POST['id_kelas'];
        if ($_FILES["dok"]["size"] == 0) {
            echo "empty";
            header("Location: ".url("/guru/materi.php?kd=".$id_kelas));
            exit;
        }else if(move_uploaded_file($_FILES["dok"]["tmp_name"], $dir)){
            $conn->query("INSERT INTO `tbmateri`(`id_mapel_dtl`, `nm_materi`, `dokumen`) VALUES ((SELECT id_mapel_dtl FROM tbmapeldtl tmd WHERE tmd.id_guru = '$id_guru' AND tmd.id_kelas = '$id_kelas' LIMIT 1),'$nm_materi','$dir')");
            header("Location: ".url("/guru/materi.php?kl=".$id_kelas));
            exit;
        }
    }
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $_DELETE = json_decode(file_get_contents('php://input'), true);
    $id_mapel = $_DELETE['idMapel'];
    $conn->query("DELETE FROM tbmapel WHERE id_mapel = $id_mapel;");
    $response = [
        'message' => "succes delete kelas",
    ];
}

?>