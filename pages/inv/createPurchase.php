<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$id_dispo = $_POST['id_dispo'];
$userid = $_POST['userid'];
$faktur = $_POST['faktur'];
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$ket = $_POST['ket'];
$seri = $_POST['seri'];

$sql = "CALL createPurchase ('" . $faktur . "', '" . $nama . "','" . $tanggal . "', " . $harga . "," . $qty . ", '" . $ket . "', '" . $seri . "', " . $userid . "," . $id_dispo . ", " . $idmemo . ")";
$query = mysqli_query($conn, $sql);
// echo $nama . $tanggal . $harga . $qty . $ket . $seri . $userid . $id_dispo . $idmemo;
