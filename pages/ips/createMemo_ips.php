<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$depreid = $_POST['depreid'];
$unitid = $_POST['unitid'];
$ruangid = $_POST['ruangid'];
$ket = $_POST['ket'];
$biaya = $_POST['biaya'];
$user_id = $_POST['user_id'];
$privilege_id = $_POST['privilege_id'];

$sql = "CALL createMemo_ips (" . $asetid . "," . $depreid . "," . $unitid . ",  " . $ruangid . ", '" . $ket . "'," . $biaya . "," . $user_id . "," . $privilege_id . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $depreid . $unitid . $ruangid . $ket . $biaya . $user_id . $privilege_id;
