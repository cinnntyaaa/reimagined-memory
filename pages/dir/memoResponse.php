<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$acc = $_POST['acc'];
$ket = $_POST['ket'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$ids = $_POST['ids'];
$userid = $_POST['userid'];

$sql = "CALL memoResponse_direksi (" . $idmemo . ", " . $acc . ", '" . $ket . "', " . $harga . "," . $qty . ", " . $ids . ", " . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo .  $acc . $ket . $harga . $qty . $ids . $userid;