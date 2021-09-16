<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$depreid = $_POST['depreid'];
$unitid = $_POST['unitid'];
$kondisi = $_POST['kondisi'];
$ket = $_POST['ket'];
$userid = $_POST['userid'];

$sql = "CALL createKondisi_request(" . $asetid . "," . $depreid . "," . $unitid . ",  " . $kondisi . ", '" . $ket . "', " . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $depreid . $unitid . $kondisi . $ket . $userid;