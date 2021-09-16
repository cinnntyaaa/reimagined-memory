<?php
include "../../koneksi.php";
$memoid = $_POST['memoid'];

$sql = "CALL deleteMemo_ips (" . $memoid . ")";
$query = mysqli_query($conn, $sql);
