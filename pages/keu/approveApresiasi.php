<?php
include "../../koneksi.php";
$memoid = $_POST['memoid'];
$depresid = $_POST['depresid'];
$apresid = $_POST['apresid'];
$tipe = $_POST['tipe'];

$sql = "CALL approveApresiasi (" . $memoid . "," . $depresid . ", " . $apresid . "," . $tipe . ")";
$query = mysqli_query($conn, $sql);
// echo $memoid . $depresid . $apresid . $tipe;