<?php include("../unit/template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Pengadaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Pengadaan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <!-- <th>KODE</th> -->
                                            <th>JUDUL</th>
                                            <!-- <th>KETERANGAN</th> -->
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <th>STATUS</th>
                                            <!-- <th>DISPOSISI</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th>
                                            <th>ATTACHMENT REKOM</th>
                                            <th>TANGGAL DISPOSISI</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL disposisiList (" . $user_id . ")";
                                        $outp = array();
                                        $dirUpload = "../../file/";
                                        if (mysqli_multi_query($conn, $sql)) {
                                            do {
                                                // Store first result set
                                                if ($result = mysqli_store_result($conn)) {
                                                    $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                    // Fetch one and one row
                                                }
                                            } while (mysqli_next_result($conn));
                                            foreach ($outp[0] as $data) {
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
                                                if ($data['attach_rekom'] == "") {
                                                    $attach = "-";
                                                } else {
                                                    $attach = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran Rekom'</a>";
                                                }
                                                $biaya_dispo = ($data['biaya_dispo'] == "-" ? '-' : rupiah($data['biaya_dispo']));
                                                echo "
                                            <tr class='parent' id=" . $no . ">
                                              <td class='text-center align-middle'>" . $no . "</td>
                                              <td class='align-middle'>$data[tgl_memo]</td>
                                              <td class='d-none'>$data[KODE]</td>
                                              <td class='align-middle'>$data[JUDUL]</td>
                                              <td class='d-none'>$data[KETERANGAN]</td>
                                              <td class='align-middle'>$data[pemohon]</td>
                                              <td class='align-middle'>$data[unit]</td>
                                              <td class='text-center align-middle'>$status</td>
                                              <td class='d-none'>$data[disposisi]</td>
                                              <td class='d-none'>" . rupiah($data['biaya_dispo']) . "</td>
                                              <td class='d-none'>$data[qty_dispo]</td>
                                              <td class='d-none'>$attach</td>
                                              <td class='d-none'>$data[tgl_dispo]</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Kode :</td>
                                                <td colspan=4>$data[KODE]</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Keterangan :</td>
                                                <td colspan=4>$data[KETERANGAN]</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Disposisi :</td>
                                                <td colspan=4>$data[disposisi]</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Biaya Disposisi :</td>
                                                <td colspan=4>$biaya_dispo</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Jumlah Disposisi :</td>
                                                <td colspan=4>$data[qty_dispo]</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>File :</td>
                                                <td colspan=4>$attach</td>
                                            </tr>
                                            <tr class='child-" . $no . "' style='display: none;'>
                                                <td colspan=2>Tgl Disposisi :</td>
                                                <td colspan=4>$data[tgl_dispo]</td>
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
<?php
include("../unit/template/bawah.php");
?>
<script>
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