<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$depreid = $_POST['depreid'];
$unit = $_POST['unit'];
$kondisi = $_POST['kondisi'];
$userid = $_POST['userid'];

$sql = "CALL createKondisi (" . $asetid . "," . $depreid . "," . $unit . ",  " . $kondisi . ", " . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $depreid . $unit . $kondisi . $userid;