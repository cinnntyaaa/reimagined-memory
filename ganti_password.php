b<?php
session_start();
error_reporting(0);
if (!isset($_SESSION["user"])) {
?>
    <script>
        alert("Silakan Coba Lagi!");
        document.location = 'login.php';
    </script>
<?php
}
if ($_SESSION['privilege_id'] == "10") {
    require "template/unit/navbar_unit.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "7") {
    require "template/unit/navbar_akutansi.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "4") {
    require "template/unit/navbar_direksi.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "2") {
    require "template/unit/navbar_admum.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "3") {
    require "template/unit/navbar_ttb.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "5") {
    require "template/unit/navbar_tbb.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "6") {
    require "template/unit/navbar_inventaris.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "8") {
    require "template/unit/navbar_ips.php";
    require "template/unit/template_ganti_password.php";
} else if ($_SESSION['privilege_id'] == "9") {
    require "template/unit/navbar_lelang.php";
    require "template/unit/template_ganti_password.php";
}
?>