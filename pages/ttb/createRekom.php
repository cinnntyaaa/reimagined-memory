<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$userid = $_POST['user_id'];
$harga = $_POST['harga_rekom'];
$ket = $_POST['ket'];
$forward = $_POST['forward'];
$folder = "file/";
$nama_file = $_FILES['fileupload']['name'];
$file = $folder . $nama_file;

// ambil data file
$namaFile = $_FILES['fileupload']['name'];
$namaSementara = $_FILES['fileupload']['tmp_name'];

// tentukan lokasi file akan dipindahkan
$dirUpload = "file/";

$temp = explode(".", $_FILES["fileupload"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);

// pindahkan file
$terupload = move_uploaded_file($namaSementara, $dirUpload . $newfilename);

if (!$terupload) {
    $nama_file = "";
} else {
    $nama_file = $newfilename;
}

$sql = "CALL createRekom (" . $idmemo . "," . $userid . "," . $harga . ",'" . $ket . "','" . $nama_file . "'," . $forward . ")";
// echo $idmemo . $userid . $harga . $ket . $nama_file;
// return false;
$query = mysqli_query($conn, $sql);
if ($query) {
    echo '<script>alert("Berhasil menambahkan data.");</script>';
} else {
    echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
}
