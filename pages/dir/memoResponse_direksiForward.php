<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$user_id = $_POST['user_id'];
$forward = $_POST['forward'];
$ketForward = $_POST['ketForward'];

$sql = "CALL memoResponse_direksiForward (" . $idmemo . ", " . $user_id . ", " . $forward . ", '" . $ketForward . "')";
$query = mysqli_query($conn, $sql);
// echo $idmemo . $user_id . $forward . $ketForward;
