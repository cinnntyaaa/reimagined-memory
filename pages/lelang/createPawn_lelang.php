<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$kondisiid = $_POST['kondisi'];
$harga = $_POST['harga'];
$ket = $_POST['ket'];
$user_id = $_POST['user_id'];

$sql = "CALL createPawn_lelang(" . $asetid . "," . $kondisiid . "," . $harga . ",'" . $ket . "'," . $user_id . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $user_id . $ket;