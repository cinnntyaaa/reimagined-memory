<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$userid = $_POST['user_id'];

$sql = "CALL memoResponse_direksi(" . $idmemo . ",4,'',0,0,6,6," . $userid . ")";
$query = mysqli_query($conn, $sql);
// echo $idmemo . $userid;