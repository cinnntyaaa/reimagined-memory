<?php
include "../../koneksi.php";
$id_beli = $_POST['id_beli'];
$dispoid = $_POST['dispoid'];
$memoid = $_POST['memoid'];
$depresi = $_POST['depresi'];
$label = $_POST['label'];

$sql = "CALL deleteDepresiasi (" . $id_beli . "," . $dispoid . ", " . $memoid . "," . $depresi . ", " . $label . ")";
$query = mysqli_query($conn, $sql);
// echo $id_beli . $dispoid . $memoid . $depresi . $label;