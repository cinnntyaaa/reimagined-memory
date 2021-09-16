<?php
error_reporting(0);
session_start();

if ($_SESSION["privilege_id"] == "10") {
    header("Location: pages/unit/newMemo.php");
} else if ($_SESSION["privilege_id"] == "2") {
    header("Location: pages/admum/memoList_admum.php");
} else if ($_SESSION["privilege_id"] == "3") {
    header("Location: pages/ttb/memoList_ttb.php");
} else if ($_SESSION["privilege_id"] == "4") {
    header("Location: pages/dir/memo_dir.php");
} else if ($_SESSION["privilege_id"] == "5") {
    header("Location: pages/tbb/disposisiList_tbb.php");
} else if ($_SESSION["privilege_id"] == "6") {
    header("Location: pages/inv/disposisi_list.php");
} else if ($_SESSION["privilege_id"] == "7") {
    header("Location: pages/keu/pembelianList.php");
} else if ($_SESSION["privilege_id"] == "8") {
    header("Location: pages/ips/assetList_pemeliharaan.php");
} else if ($_SESSION["privilege_id"] == "9") {
    header("Location: pages/lelang/lelangList.php");
}
include "koneksi.php";
?>
<html>

<head>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <link href="assets/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-css.css" />
    <title>RSIM - ASSET</title>
    <link rel="icon" type="image/png" href="assets/img/tv.png">
</head>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="assets/img/rsi.jpg" id="icon" alt="User Icon" />
                <h1>RSIM - ASSET</h1>
            </div>

            <!-- Login Form -->
            <form name="login" action="login.php" method="post">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="username" autocomplete="off">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" value="Log In" name="submit">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Copyright &copy; RSIM Sumberrejo 2021</a>
            </div>

        </div>
    </div>
    <?php
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $submit = $_POST['submit'];
    if ($submit) {
        $sql = "CALL login ('$username', '$password')";
        $query = mysqli_query($conn, $sql);
        $hasil = mysqli_fetch_array($query);
        if ($hasil['privilege'] == "unit") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
    ?>
            <script>
                document.location = 'pages/unit/newMemo.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "admum") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/admum/memoList_admum.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "ttb") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/ttb/memoList_ttb.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "direksi") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/dir/memo_dir.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "tbb") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/tbb/disposisiList_tbb.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "inventaris") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/inv/disposisi_list.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "akutansi") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/keu/pembelianList.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "ips") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/ips/assetList_pemeliharaan.php';
            </script>
        <?php
        } else if ($hasil['privilege'] == "lelang") {
            $_SESSION['user'] = $hasil["user"];
            $_SESSION['user_id'] = $hasil["id_user"];
            $_SESSION['privilege_id'] = $hasil["id_privilege"];
            $_SESSION['unit_id'] = $hasil["id_unit"];
            $_SESSION['unit'] = $hasil["unit"];
        ?>
            <script>
                document.location = 'pages/lelang/lelangList.php';
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Silahkan Coba Lagi!");
            </script>
    <?php
        }
    }
    ?>
</body>

</html>