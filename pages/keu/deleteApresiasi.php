<?php
include "../../koneksi.php";
$memo_id = $_POST['memo_id'];
$depresi_id = $_POST['depresi_id'];
$apresiasi_id = $_POST['apresiasi_id'];

$sql = "CALL deleteApresiasi (" . $memo_id . "," . $depresi_id . ", " . $apresiasi_id . ")";
$query = mysqli_query($conn, $sql);
// echo $memoid . $depresid . $apresid . $tipe;