<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$userid = $_POST['user_id'];
$forward = $_POST['forward'];

$sql = "CALL createForwardBetterment_admum (" . $idmemo . "," . $userid . "," . $forward . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo . $userid;