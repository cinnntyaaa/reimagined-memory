<?php
session_start();
error_reporting(0);
if (!isset($_SESSION["user"])) {
?>
  <script>
    alert("Silakan Coba Lagi!");
    document.location = '../../login.php';
  </script>
<?php
}
if ($_SESSION['privilege_id'] == "10") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "2") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "3") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "4") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "5") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "6") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "7") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "8") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "9") {
  include("../unit/template/atas.php");
  include("template_changePassword.php");
  include("../unit/template/bawah.php");
}
