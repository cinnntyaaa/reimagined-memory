<?php
include "../../koneksi.php";
$idmutasi = $_POST['idmutasi'];
$acc = $_POST['acc'];
$userid = $_POST['userid'];

$sql = "CALL createResponseMutasi_unit (" . $userid . "," . $idmutasi . "," . $acc . ")";
$query = mysqli_query($conn, $sql);
// echo $userid . $idmutasi . $acc;