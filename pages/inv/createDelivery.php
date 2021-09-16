<?php
include "../../koneksi.php";
$memoid = $_POST['memoid'];
$dispoid = $_POST['dispoid'];

$sql = "CALL createDelivery (" . $memoid . "," . $dispoid . ")";
$query = mysqli_query($conn, $sql);
// echo $memoid . $dispoid;
