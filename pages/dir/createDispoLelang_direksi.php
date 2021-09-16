<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$user_id = $_POST['user_id'];
$ket = $_POST['ket'];

$sql = "CALL createDispoLelang_direksi(" . $asetid . "," . $user_id . ",'" . $ket . "')";
$query = mysqli_query($conn, $sql);
// echo $asetid . $user_id . $ket;