<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Laporan Memo Pengadaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Pengadaan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="reportMemo_admum.php" class="form-inline mb-3">
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
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <!-- <th>KODE</th> -->
                                            <th>JUDUL</th>
                                            <!-- <th>KETERANGAN</th>
                                            <th>LATAR BELAKANG</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th> -->
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <!-- <th>UNTUK</th> -->
                                            <th>STATUS</th>
                                            <!-- <th>BIAYA REKOM</th>
                                            <th>DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>JUMLAH DISPOSISI</th> -->
                                            <th>PIC</th>
                                            <th>USER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $sql = "CALL reportMemo_admum ('" . $tgl_awal . "', '" . $tgl_akhir . "')";
                                            $query = mysqli_query($conn, $sql);
                                            while ($data = mysqli_fetch_array($query)) {
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
                                                $biaya_dispo = ($data['biaya_dispo'] == "-" ? '-' : rupiah($data['biaya_dispo']));
                                                $biaya_rekom = ($data['biaya_rekom'] == "0.00" ? '-' : rupiah($data['biaya_rekom']));
                                                echo "
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='d-none'>$data[KODE]</td>
                                                    <td class='align-middle'>$data[JUDUL]</td>
                                                    <td class='d-none'>$data[KETERANGAN]</td>
                                                    <td class='d-none'>$data[latar_memo]</td>
                                                    <td class='d-none'>" . rupiah($data['harga_memo']) . "</td>
                                                    <td class='d-none'>$data[qty_memo]</td>
                                                    <td class='align-middle'>$data[pemohon]</td>
                                                    <td class='align-middle'>$data[unit]</td>
                                                    <td class='d-none'>$data[untuk]</td>
                                                    <td class='text-center align-middle'>$status</td>
                                                    <td class='d-none'>" . rupiah($data['biaya_rekom']) . "</td>
                                                    <td class='d-none'>$data[disposisi]</td>
                                                    <td class='d-none'>$biaya_dispo</td>
                                                    <td class='d-none'>$data[qty_dispo]</td>
                                                    <td class='align-middle'>$data[pic]</td>
                                                    <td class='align-middle'>$data[user]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Kode :</td>
                                                        <td colspan=6>$data[KODE]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Keterangan :</td>
                                                        <td colspan=6>$data[KETERANGAN]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Latar Belakang :</td>
                                                        <td colspan=6>$data[latar_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya :</td>
                                                        <td colspan=6>" . rupiah($data['harga_memo']) . "</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Jumlah :</td>
                                                        <td colspan=6>$data[qty_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Unit :</td>
                                                        <td colspan=6>$data[unit]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Ruang :</td>
                                                        <td colspan=6>$data[untuk]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya Rekom :</td>
                                                        <td colspan=6>$biaya_rekom</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Disposisi :</td>
                                                        <td colspan=6>$data[disposisi]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya Disposisi :</td>
                                                        <td colspan=6>$biaya_dispo</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Jumlah Disposisi :</td>
                                                        <td colspan=6>$data[qty_dispo]</td>
                                                    </tr>";
                                                $no++;
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