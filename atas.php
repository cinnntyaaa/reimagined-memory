<?php
// session_start();
// if (!isset($_SESSION["user"])) {
// ?>
//     <script>
//         alert("Silakan Coba Lagi!");
//         document.location = '../../login.php';
//     </script>
<?php
// }
// if ($_SESSION['privilege_id'] !== "10") {
// ?>
//     <script>
//         alert("Silakan Coba Lagi!");
//         document.location = '../../login.php';
//     </script>
// <?php
// }
$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$privilege_id = $_SESSION['privilege_id'];
$unit_id = $_SESSION['unit_id'];
$namaUnit = $_SESSION['unit'];
include "../../koneksi.php";

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, '.', ',');
    return $hasil_rupiah;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>RSIM &mdash; ASSET</title>
    <link rel="icon" type="image/png" href="../../../assets/img/tv.png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <!-- <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker.min.css"> -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

    <!-- <script src="../../assets/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- active sidebar -->
    
    <style>
        #memo label,
        #unit,
        .larger {
            font-size: larger;
        }

        .table {
            vertical-align: middle;
            color: black;
        }

        .table th {
            text-align: center;
        }

        hr.solid {
            border-top: 2px solid black;
        }

        hr.hr-text {
            position: relative;
            border: none;
            height: 1px;
            background: grey;
            text-align: -webkit-center;
        }

        hr.hr-text::before {
            content: attr(data-content);
            display: inline-block;
            background: #fff;
            font-weight: bold;
            font-size: 0.85rem;
            border-radius: 30rem;
            padding: 0.1rem 1rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                            <div class="d-sm-none d-lg-inline-block h5">Hi, <?= $username ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in</div>
                            <a href="changePassword.php" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="../../logout.php" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="newMemo.php">RSIM - ASSET</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="newMemo.php">ASSET</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="newMemo.php">Memo Baru</a></li>
                                <li><a class="nav-link" href="reportAsetHilang.php">Pelaporan Aset Hilang</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-share-square"></i><span>Peminjaman</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="formPeminjaman.php">Form Peminjaman</a></li>
                                <li><a class="nav-link" href="formPenerimaan.php">Form Penerimaan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                            <ul class="dropdown-menu coba">
                                <li><a class="nav-link" href="/assetku/pages/unit/reportAset.php">Laporan Aset Unit</a></li>
                                <li><a class="nav-link" href="/assetku/pages/unit/reportMemo.php">Laporan Memo</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="#" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-question"></i> Panduan
                        </a>
                    </div>
                </aside>
            </div>

<script>
$(".dropdown-menu").each(function() {
    var navItem = $(this);
    console.log('url kolom', location.pathname)
    console.log('url href', navItem.find("a").attr("href"))
    if (navItem.find("a").attr("href") == location.pathname) {
        navItem.addClass("active"); //class active iki sesuaikan karo template mu, kondisi opo leng marai link e aktif
    } else {
        if (navItem.find("a").attr("href") == "#") {
            for (var i = 0; i < $('.coba').length; i++) {
                var html = $('.coba').find("a")
                for (var i = 0; i < html.length; i++);
                var html2 = html[i]
                if ($(html2).attr("href") == location.pathname) {
                    navItem.addClass("active");
                }
            }
        }
    }
})
</script>