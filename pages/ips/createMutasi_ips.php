<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$unit = $_POST['unit'];
$ruang = $_POST['ruang'];
$userid = $_POST['userid'];

$sql = "CALL createMutasi_ips (" . $asetid . "," . $unit . "," . $ruang . "," . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $unit . $ruang . $userid;