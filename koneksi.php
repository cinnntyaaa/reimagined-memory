<?php 
// $conn = mysqli_connect("192.168.1.221","root","ROOT","dbasset");
// $conn = mysqli_connect("localhost","root","","dbasset");
$conn = mysqli_connect("localhost","root","","dbasset_temp");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
