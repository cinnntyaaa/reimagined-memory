<?php
session_start();
if (!isset($_SESSION["user"])) {
?>
    <script>
        alert("Silakan Coba Lagi!");
        document.location = '../../login.php';
    </script>
<?php
}
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="../../assets/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <link rel="stylesheet" href="../../assets/css/font-css.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap-iso.css" />
    <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
    <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" /> -->

    <!-- <link rel="stylesheet" href="../../assets/css/bootstrap-table.min.css" /> -->
    <script src="../../assets/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
    <script src="../../assets/js/jquery-1.11.3.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
    <script src="../../assets/js/bootstrap-table.min.js"></script>


    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        /* #memo label,
        #unit, */
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

        .inputView {
            width: 40%;
            padding: 6px 6px;
            margin: 3px 3px;
            display: inline-block;
            border: 1px solid grey;
            border-radius: 4px;
            box-sizing: border-box;
            text-align: center;
        }

        .underlineHover:after {
            display: block;
            left: 0;
            bottom: -10px;
            width: 0;
            height: 2px;
            background-color: grey;
            content: "";
            color: #0d0d0d;
            width: 100%;
        }

        select {
            border-radius: 5px;
            padding: 2px;
        }

        textarea {
            border-radius: 5px;
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
                            <a href="../pass/changePassword.php" class="dropdown-item has-icon">
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
            <?php
            if ($_SESSION['privilege_id'] == "10") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/newMemo.php">Memo Baru</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/reportAsetHilang.php">Pelaporan Aset Hilang</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-share-square"></i><span>Peminjaman</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/formPeminjaman.php">Form Peminjaman</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/formPenerimaan.php">Form Penerimaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/reportAset.php">Laporan Aset Unit</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/unit/reportMemo.php">Laporan Memo</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "7") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Depresiasi</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/pembelianList.php">Memo Depresiasi</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/dispoBettermentList_akutansi.php">Memo Pemeliharaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/reportDepresiasi_keu.php">Laporan Depresiasi</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/reportBettermentBase_keu.php">Laporan Pemeliharaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/laporan/data_induk_aset.php">Data Induk Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/#.php">Data Aset Ruangan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/#.php">Data Non Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/keu/#.php">Laporan Kegiatan Lelang</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "4") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/memo_dir.php">Memo Pengadaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/memoBettermentList_direksi.php">Memo Pemeliharaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/lelangDispo_direksi.php">Memo Lelang</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/hentiAset_direksi.php">Memo Penghentian</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/hapusAset_direksi.php">Memo Penghapusan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/reportDisposisi_direksi.php">Memo Pengadaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/reportBettermentBase_direksi.php">Memo Pemeliharaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/#.php">Data Induk Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/#.php">Data Aset Ruangan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/#.php">Data Non Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/dir/#.php">Laporan Kegiatan Lelang</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "2") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/admum/memoList_admum.php">Memo Pengadaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/admum/memoBettermentList_admum.php">Memo Pemeliharaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/admum/reportMemo_admum.php">Memo Pengadaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/admum/reportBetterment_admum.php">Memo Pemeliharaan</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "3") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ttb/memoList_ttb.php">Memo Pengadaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ttb/reportMemo_ttb.php">Memo Pengadaan</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "5") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/tbb/disposisiList_tbb.php">Memo Pengadaan</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "6") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/disposisi_list.php">Memo Pengadaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/dispoBettermentList_inventaris.php">Memo Pemeliharaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/rekomLelang_inventaris.php">Memo Lelang</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/hentiAset_inventaris.php">Memo Penghentian</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/hapusAset_inventaris.php">Memo Penghapusan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/requestList_hilang.php">Aset Hilang</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Mutasi</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/mutasiList_inventaris.php">Mutasi Aset Tetap</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Pengiriman</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/deliveryList.php">Pengiriman Aset</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/inv/laporanAsset_inventaris.php">Pembelian</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/laporan/data_induk_aset.php">Data Induk Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/laporan/data_aset_ruangan.php">Data Aset Ruangan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/laporan/data_non_aset.php">Data Non Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/laporan/laporan_kegiatan_lelang.php">Laporan Kegiatan Lelang</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "8") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/assetList_pemeliharaan.php">Memo Pemeliharaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Pemeliharaan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/pemeliharaan.php">Pemeliharaan Aset</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/requestList_service.php">Permintaan Servis</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Mutasi</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/mutasiList_ips.php">Mutasi Sementara</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/reportPemeliharaan_ips.php">Pemeliharaan</a></li>
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/ips/reportBetterment_pemeliharaan.php">Memo Pemeliharaan</a></li>
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
            <?php
            } else if ($_SESSION['privilege_id'] == "9") {
            ?>
                <div class="main-sidebar">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <img alt="image" src="../../assets/img/logomuh.png" class="rounded-circle mr-1 h-50">
                            <a href="newMemo.php">RSIM - ASSET</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="newMemo.php">ASSET</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-signature"></i><span>Memo</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/lelang/lelangList.php">Memo Lelang</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown hadeh">
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-download"></i><span>Laporan</span></a>
                                <ul class="dropdown-menu">
                                    <li class="coba"><a class="nav-link" href="/assetku/pages/lelang/reportAsset_lelang.php">Aset Lelang</a></li>
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
            <?php
            }
            ?>