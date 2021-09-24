<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Laporan Pembelian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Laporan Pembelian</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="laporanAsset_inventaris.php" class="form-inline mb-3">
                                <div class="form-group">
                                    <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                                </div>
                                <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                                <div class="form-group">
                                    <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary p-2 ml-2 larger">Cari</button>
                            </form>
                            <div class="table-responsive">
                                <hr data-content="LAPORAN PEMBELIAN ASET BELUM TERVALUASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <!-- <th>KODE</th> -->
                                            <th>NAMA</th>
                                            <th>NOMOR SERI</th>
                                            <th>HARGA</th>
                                            <th>JUMLAH</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $no = 1;
                                            $sql = "CALL reportPembelian_inventaris(" . $user_id . ",'" . $tgl_awal . "','" . $tgl_akhir . "')";
                                            $outp = array();
                                            if (mysqli_multi_query($conn, $sql)) {
                                                do {
                                                    // Store first result set
                                                    if ($result = mysqli_store_result($conn)) {
                                                        $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                        // Fetch one and one row
                                                    }
                                                } while (mysqli_next_result($conn));
                                                foreach ($outp[0] as $data) {
                                                    echo "
                                                    <tr>
                                                        <td class='text-center align-middle'>" . $no . "</td>
                                                        <td class='align-middle'>$data[TANGGAL]</td>
                                                        <td class='d-none'>$data[kode_memo]</td>
                                                        <td class='align-middle'>$data[NAMA]</td>
                                                        <td class='align-middle'>$data[NOMOR_SERI]</td>
                                                        <td class='text-right align-middle'>" . rupiah($data['HARGA']) . "</td>
                                                        <td class='text-right align-middle'>$data[JUMLAH]</td>
                                                        <td class='align-middle'>$data[KETERANGAN]</td>
                                                        <td class='d-none'>$data[user_id]</td>
                                                        <td class='d-none'>$data[user_beli]</td>
                                                    </tr> ";
                                                    $no++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="LAPORAN PEMBELIAN ASET TELAH TERVALUASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <!-- <th>KODE MEMO</th> -->
                                            <th>KODE BARANG</th>
                                            <th>NAMA</th>
                                            <th>NOMOR SERI</th>
                                            <!-- <th>HARGA</th>
                                            <th>JUMLAH</th> -->
                                            <th>KETERANGAN</th>
                                            <!-- <th>USER ID</th>
                                            <th>USER BELI</th> -->
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $no = 1;
                                            $sql = "CALL reportPembelian_inventaris(" . $user_id . ",'" . $tgl_awal . "','" . $tgl_akhir . "')";
                                            $outp = array();
                                            if (mysqli_multi_query($conn, $sql)) {
                                                do {
                                                    // Store first result set
                                                    if ($result = mysqli_store_result($conn)) {
                                                        $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                        // Fetch one and one row
                                                    }
                                                } while (mysqli_next_result($conn));
                                                foreach ($outp[1] as $data) {
                                                    if ($data['STATUS'] == 0) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/filter.svg' title='FILTER'>"; #FILTER
                                                    } else if ($data['STATUS'] == 1) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/sent.svg' title='SENT'>"; #SENT
                                                    } else if ($data['STATUS'] == 2) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/rekom.svg' title='REKOM'>"; #REKOM
                                                    } else if ($data['STATUS'] == 3) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/process.svg' title='PROCESS'>"; #PROCESS
                                                    } else if ($data['STATUS'] == 4) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/rejected.svg' title='REJECTED'>"; #REJECTED
                                                    } else if ($data['STATUS'] == 5) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/approved.svg' title='APPROVED'>"; #APPROVED
                                                    } else if ($data['STATUS'] == 6) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/buy_less.svg' title='BUY LESS'>"; #BUY LESS
                                                    } else if ($data['STATUS'] == 7) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/buy_complete.svg' title='BUY COMPLETE'>"; #BUY COMPLETE
                                                    } else if ($data['STATUS'] == 8) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/eval_less.svg' title='EVAL LESS'>"; #EVAL LESS
                                                    } else if ($data['STATUS'] == 9) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/eval_complete.svg' title='EVAL COMPLETE'>"; #EVAL COMPLETE
                                                    } else if ($data['STATUS'] == 10) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/done.svg' title='DELIVERED'>"; #DELIVERED
                                                    } else if ($data['STATUS'] == 11) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/pending.svg' title='PENDING'>"; #PENDING
                                                    } else if ($data['STATUS'] == 12) {
                                                        $status = "<img width='30px' height='30px' src='../../assets/svg/forward.svg' title='FORWARD'>"; #FORWARD
                                                    }
                                                    echo "
                                                    <tr class='parent' id=" . $no . ">
                                                        <td class='text-center align-middle'>" . $no . "</td>
                                                        <td class='align-middle'>$data[TANGGAL]</td>
                                                        <td class='d-none'>$data[kode_memo]</td>
                                                        <td class='align-middle'>$data[kode_barang]</td>
                                                        <td class='align-middle'>$data[NAMA]</td>
                                                        <td class='align-middle'>$data[NOMOR_SERI]</td>
                                                        <td class='d-none'>" . rupiah($data['HARGA']) . "</td>
                                                        <td class='d-none'>$data[JUMLAH]</td>
                                                        <td class='align-middle'>$data[KETERANGAN]</td>
                                                        <td style='display:none'>$data[user_id]</td>
                                                        <td style='display:none'>$data[user_beli]</td>
                                                        <td class='text-center'>$status</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Harga :</td>
                                                        <td colspan=5>" . rupiah($data['HARGA']) . "</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Jumlah :</td>
                                                        <td colspan=5>$data[JUMLAH]</td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="LAPORAN PEMBELIAN NON ASET" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <!-- <th>KODE MEMO</th> -->
                                            <th>NAMA</th>
                                            <th>NOMOR SERI</th>
                                            <th>HARGA</th>
                                            <th>JUMLAH</th>
                                            <th>KETERANGAN</th>
                                            <!-- <th>USER ID</th>
                                            <th>USER BELI</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $no = 1;
                                            $sql = "CALL reportPembelian_inventaris(" . $user_id . ",'" . $tgl_awal . "','" . $tgl_akhir . "')";
                                            $outp = array();
                                            if (mysqli_multi_query($conn, $sql)) {
                                                do {
                                                    // Store first result set
                                                    if ($result = mysqli_store_result($conn)) {
                                                        $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                        // Fetch one and one row
                                                    }
                                                } while (mysqli_next_result($conn));
                                                foreach ($outp[2] as $data) {
                                                    echo "
                                                    <tr>
                                                        <td class='text-center align-middle'>" . $no . "</td>
                                                        <td class='align-middle'>$data[TANGGAL]</td>
                                                        <td class='d-none'>$data[kode_memo]</td>
                                                        <td class='align-middle'>$data[NAMA]</td>
                                                        <td class='align-middle'>$data[NOMOR_SERI]</td>
                                                        <td class='text-right align-middle'>" . rupiah($data['HARGA']) . "</td>
                                                        <td class='text-right align-middle'>$data[JUMLAH]</td>
                                                        <td class='align-middle'>$data[KETERANGAN]</td>
                                                        <td class='d-none'>$data[user_id]</td>
                                                        <td class='d-none'>$data[user_beli]</td>
                                                    </tr> ";
                                                    $no++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php include("../unit/template/bawah.php"); ?>

<!-- Page Specific JS File -->
<script>
    $(function() {
        $("#tgl_awal").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        });
        $("#tgl_akhir").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        });
    });
    $(document).ready(function() {
        $('tr.parent')
            .css("cursor", "pointer")
            .attr("title", "Click to expand/collapse")
            .click(function() {
                $(this).siblings('.child-' + this.id).toggle();
            });
    });
</script>
</body>

</html>