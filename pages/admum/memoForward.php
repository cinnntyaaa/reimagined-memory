<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$userid = $_POST['user_id'];
$forward = $_POST['forward'];

if ($forward == "3") {
    $sql = "CALL memoForward_ttb (" . $idmemo . "," . $userid . ")";
    $query = mysqli_query($conn, $sql);
    // echo $idmemo . $userid;
} else {
    $sql = "CALL memoForward_direksi (" . $idmemo . "," . $userid . "," . $forward . ")";
    $query = mysqli_query($conn, $sql);
    // echo $idmemo . $userid . $forward;
}
