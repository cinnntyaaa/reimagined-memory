<?php
include "../../koneksi.php";
$asetid = $_POST['asetid'];
$unitMutasi = $_POST['unitMutasi'];
$ruangMutasi = $_POST['ruangMutasi'];
$userid = $_POST['userid'];

$sql = "CALL createMutasi_inventaris (" . $asetid . "," . $unitMutasi . "," . $ruangMutasi . ", " . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $asetid . $unitMutasi . $ruangMutasi . $userid;