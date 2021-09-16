<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$ket = $_POST['ket'];
$harga = $_POST['harga'];
$acc = $_POST['acc'];
$pic = $_POST['pic'];
$user_id = $_POST['user_id'];

$sql = "CALL createDispoBetterment_direksi(" . $idmemo . ",'" . $ket . "'," . $harga . "," . $acc . "," . $pic . "," . $user_id . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo . $ket . $harga . $acc . $pic . $user_id;