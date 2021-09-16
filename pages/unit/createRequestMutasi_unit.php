<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$unitid = $_POST['unitid'];
$ruangid = $_POST['ruangid'];
$unit = $_POST['unit'];
$ruangMutasi = $_POST['ruangMutasi'];
$userid = $_POST['userid'];

$sql = "CALL createRequestMutasi_unit (" . $asetid . "," . $unitid . "," . $ruangid . "," . $unit . "," . $ruangMutasi . "," . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $unit . $ruang . $userid;