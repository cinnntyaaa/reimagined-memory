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
                                <hr data-content="MEMO PENGADAAN YANG BELUM TERBELI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>PIC</th>
                                            <!-- <th>KODE</th> -->
                                            <th>JUDUL</th>
                                            <!-- <th>KETERANGAN</th> -->
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <th>STATUS</th>
                                            <!-- <th>DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>JUMLAH</th>
                                            <th>ATTACHMENT REKOM</th>
                                            <th>TANGGAL DISPOSISI</th> -->
                                            <th>PROSES</th>
                                            <th>REJECT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL disposisiList (" . $user_id . ")";
                                        $outp = array();
                                        $dirUpload = "file/";
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
                                                echo "
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='align-middle'>$data[tgl_memo]</td>
                                                    <td class='align-middle'>$data[pic]</td>
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
                                                    <td class='text-center align-middle'><button class='btn bg-transparent' onclick=view($data[idmemo],$data[id_dispo])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                    <td class='text-center align-middle'><button class='btn bg-transparent' onclick=reject($data[idmemo],$data[id_dispo])><img width='30px' src='../../assets/svg/hapus.svg'></button></td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Kode :</td>
                                                    <td colspan=7>$data[KODE]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=7>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Disposisi :</td>
                                                    <td colspan=7>$data[disposisi]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Biaya Disposisi :</td>
                                                    <td colspan=7>" . rupiah($data['biaya_dispo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Jumlah Disposisi :</td>
                                                    <td colspan=7>$data[qty_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>File :</td>
                                                    <td colspan=7>$attach</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Tgl Disposisi :</td>
                                                    <td colspan=7>$data[tgl_dispo]</td>
                                                </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="MEMO PENGADAAN YANG TELAH TERBELI" class="hr-text">
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
                                        $no = 1;
                                        $sql = "CALL disposisiList (" . $user_id . ")";
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
                                                echo "
                                            <tr>
                                              <td class='text-center align-middle'>" . $no . "</td>
                                              <td class='align-middle'>$data[TANGGAL]</td>
                                              <td class='d-none'>$data[KODE]</td>
                                              <td class='align-middle'>$data[NAMA]</td>
                                              <td class='align-middle'>$data[NOMOR_SERI]</td>
                                              <td class='text-right align-middle'>" . rupiah($data['HARGA']) . "</td>
                                              <td class='text-right align-middle'>$data[JUMLAH]</td>
                                              <td class='align-middle'>$data[KETERANGAN]</td>
                                            </tr> ";
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content black">
            <div class="modal-header border-bottom p-3">
                <a class="modal-title h4"><u>Form Pembelian Aset</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-2" id="disposisiView">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content black">
            <div class="modal-header border-bottom p-3">
                <a class="modal-title h4"><u>Rincian Memo</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="h5 text-center">
                    Apakah anda yakin akan membatalkan pembelian?
                </div>
                <div class="text-center">
                    <button class='btn btn-primary larger' type='submit' id='submit2'>Ya</button>
                    <button class='btn btn-primary larger' type="button" class="close" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../unit/template/bawah.php");
?>

<!-- Page Specific JS File -->
<script>
    function view(idmemo, id_dispo) {
        var user_id = "<?php echo $user_id ?>";
        $.ajax({
            url: 'proses_disposisiView.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                id_dispo: id_dispo,
                user_id: user_id
            },
            dataType: 'html',
            success: function(data) {
                $("#myModal").modal("show");
                $("#disposisiView").html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    }

    function reject(idmemo, id_dispo) {
        $("#myModal2").modal("show");
        var user_id = <?php echo $user_id ?>;
        document.getElementById("submit2").onclick = (function() {
            document.getElementById('submit2').setAttribute("disabled", "disabled");
            $.ajax({
                url: 'rejectInventaris.php',
                type: 'POST',
                data: {
                    idmemo: idmemo,
                    user_id: user_id
                },
                dataType: 'html',
                success: function(data) {
                    location.reload();
                    // console.log(data);
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        });
    }
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