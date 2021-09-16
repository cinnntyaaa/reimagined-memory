<?php
// $conn	= new mysqli("192.168.1.221", "root", "ROOT", "dbasset");
$conn = new mysqli("localhost","root","","dbasset");
if(mysqli_connect_error()){
	die("DBConnection failed: ".mysqli_connect_error());
}

$param	= mysqli_real_escape_string($conn, $_POST['x']);
$outp	= new \stdClass();	//	Declaring Object
$query	= "";

switch($param){
	case 1:
		$query	= "CALL alarmAdmum();";
		break;
	case 2:
		$query	= "CALL alarmDireksi();";
		break;
	case 3:
		$query	= "CALL alarmInventaris();";
		break;
	case 4:
		$query	= "CALL alarmAkutansi();";
		break;
	case 5:
		$query	= "CALL alarmIPS();";
		break;
	case 6:
		$query	= "CALL alarmLelang();";
		break;
	case 7:
		$query	= "CALL alarmTTB();";
		break;
	case 8:
		$query	= "CALL alarmTBB();";
		break;
	default:
		$query	= "SELECT 'memobeli', 'memomaint';";
}

$result	= $conn -> query($query);
$outp	= $result -> fetch_all(MYSQLI_ASSOC);
$result	->close();
$conn	->close();

echo json_encode($outp);
