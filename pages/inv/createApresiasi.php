<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$idaset = $_POST['idaset'];
$idunit = $_POST['idunit'];
$depreid = $_POST['depreid'];
$harga = $_POST['harga'];
$ket = $_POST['ket'];
$user_id = $_POST['user_id'];

$sql = "CALL createApresiasi (" . $idmemo . "," . $idaset . "," . $idunit . "," . $depreid . "," . $harga . ",'" . $ket . "'," . $user_id . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo . $idaset . $idunit . $depreid . $harga . $ket . $user_id;