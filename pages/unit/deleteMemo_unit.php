<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$user_id = $_POST['user_id'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

$sql = "CALL deleteMemo_unit (" . $idmemo . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo;
$status = mysqli_affected_rows($conn);
echo $user_id . ";" . $tgl_awal . ";" . $tgl_akhir . ";" . $status;
