<?php
include "../../koneksi.php";
$idbeli = $_POST['idbeli'];
$id_dispo = $_POST['id_dispo'];
$idmemo = $_POST['idmemo'];
$tahun = $_POST['tahun'];
$nisut = $_POST['nisut'];
$jenis = $_POST['jenis'];
$kategori = $_POST['kategori'];
$golongan = $_POST['gol'];
$tipe = $_POST['tipe'];

$sql = "CALL createDepresiasi (" . $tahun . "," . $nisut . ", " . $idbeli . "," . $id_dispo . ", " . $idmemo . ", " . $jenis . "," . $kategori . "," . $golongan . "," . $tipe . ")";
$query = mysqli_query($conn, $sql);
// echo $tahun . $nisut . $idbeli . $id_dispo . $idmemo . $jenis . $kategori . $golongan . $tipe;