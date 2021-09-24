<?php
include "../../koneksi.php";
$idmutasi = $_POST['idmutasi'];
$back = $_POST['back'];
$userid = $_POST['userid'];

$sql = "CALL createResponseMutasi_unit (" . $userid . "," . $idmutasi . ",4)";
$query = mysqli_query($conn, $sql);
// echo $userid . $idmutasi . $back;