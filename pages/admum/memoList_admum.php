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
                            <hr data-content="MEMO PENGADAAN BELUM DIKONFIRMASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <!-- <th>KODE</th> -->
                                            <th>JUDUL</th>
                                            <!-- <th>KETERANGAN</th>
                                            <th>LATAR BELAKANG</th>
                                            <th>ATTACHMENT</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th> -->
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <!-- <th>UNTUK</th> -->
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_admum()";
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
                                                if ($data['attach_memo'] == "") {
                                                    $attach = "-";
                                                } else {
                                                    $attach = "<a href='" . $dirUpload . $data['attach_memo'] . "'>'File Lampiran'</a>";
                                                }
                                                echo "
                                                    <tr class='parent' id=" . $no . ">
                                                        <td class='text-center align-middle'>" . $no . "</td>
                                                        <td class='d-none'>$data[KODE]</td>
                                                        <td class='align-middle'>$data[JUDUL]</td>
                                                        <td class='d-none'>$data[KETERANGAN]</td>
                                                        <td class='d-none'>$data[latar_memo]</td>
                                                        <td class='d-none'>$attach</td>
                                                        <td class='d-none'>" . rupiah($data['harga_memo']) . "</td>
                                                        <td class='d-none'>$data[qty_memo]</td>
                                                        <td class='align-middle'>$data[pemohon]</td>
                                                        <td class='align-middle'>$data[unit]</td>
                                                        <td class='d-none'>$data[untuk]</td>
                                                        <td class='text-center'><button class='btn bg-transparent' onclick=view($data[idmemo])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Kode :</td>
                                                        <td colspan=4>$data[KODE]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Keterangan :</td>
                                                        <td colspan=4>$data[KETERANGAN]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Latar Belakang :</td>
                                                        <td colspan=4>$data[latar_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>File :</td>
                                                        <td colspan=4>$attach</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya :</td>
                                                        <td colspan=4>" . rupiah($data['harga_memo']) . "</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Jumlah :</td>
                                                        <td colspan=4>$data[qty_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Unit :</td>
                                                        <td colspan=4>$data[unit]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Ruang :</td>
                                                        <td colspan=4>$data[untuk]</td>
                                                    </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                            <hr data-content="MEMO PENGADAAN TELAH DIKONFIRMASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <!-- <th>KODE</th> -->
                                            <th>JUDUL</th>
                                            <!-- <th>KETERANGAN</th>
                                            <th>LATAR BELAKANG</th>
                                            <th>ATTACHMENT MEMO</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th> -->
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <!-- <th>UNTUK</th> -->
                                            <th>STATUS</th>
                                            <!-- <th>DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>JUMLAH DISPOSISI</th> -->
                                            <th>USER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_admum()";
                                        $outp = array();
                                        if (mysqli_multi_query($conn, $sql)) {
                                            do {
                                                // Store first result set
                                                if ($result = mysqli_store_result($conn)) {
                                                    $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                    // Fetch one and one row
                                                }
                                            } while (mysqli_next_result($conn));
                                            $temp = 0;
                                            foreach ($outp[1] as $data) {
                                                if ($data['attach_memo'] == "") {
                                                    $attach2 = "-";
                                                } else {
                                                    $attach2 = "<a href='" . $dirUpload . $data['attach_memo'] . "'>'File Lampiran'</a>";
                                                }
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
                                                echo "
                                                    <tr class='parent' id=" . $no . ">
                                                        <td class='text-center align-middle'>$no</td>
                                                        <td class='d-none'>$data[KODE]</td>
                                                        <td class='align-middle'>$data[JUDUL]</td>
                                                        <td class='d-none'>$data[KETERANGAN]</td>
                                                        <td class='d-none'>$data[latar_memo]</td>
                                                        <td class='d-none'>$attach2</td>
                                                        <td class='d-none'>" . rupiah($data['harga_memo']) . "</td>
                                                        <td class='d-none'>$data[qty_memo]</td>
                                                        <td class='align-middle'>$data[pemohon]</td>
                                                        <td class='text-center align-middle'>$data[unit]</td>
                                                        <td class='d-none'>$data[untuk]</td>
                                                        <td class='text-center align-middle'>$status</td>
                                                        <td class='d-none'>$data[disposisi]</td>
                                                        <td class='d-none'>$biaya_dispo</td>
                                                        <td class='d-none'>$data[qty_dispo]</td>
                                                        <td class='align-middle'>$data[user]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Kode :</td>
                                                        <td colspan=5>$data[KODE]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Keterangan :</td>
                                                        <td colspan=5>$data[KETERANGAN]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Latar Belakang :</td>
                                                        <td colspan=5>$data[latar_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>File :</td>
                                                        <td colspan=5>$attach2</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya :</td>
                                                        <td colspan=5>" . rupiah($data['harga_memo']) . "</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Jumlah :</td>
                                                        <td colspan=5>$data[qty_memo]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Unit :</td>
                                                        <td colspan=5>$data[unit]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Ruang :</td>
                                                        <td colspan=5>$data[untuk]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Disposisi :</td>
                                                        <td colspan=5>$data[disposisi]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Biaya Disposisi :</td>
                                                        <td colspan=5>$biaya_dispo</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td>Jumlah Disposisi :</td>
                                                        <td colspan=5>$data[qty_dispo]</td>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content black">
            <div class="modal-header border-bottom p-3">
                <a class="modal-title h4"><u>Diteruskan Kepada :</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <div class="h5 text-center">
                    <select name="forward" id="forward" style="width: fit-content;">
                        <?php
                        $sql = "SELECT ID, NAMA FROM `user` WHERE PRIVILEGE_ID = 4;";
                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                            <?php while ($row = mysqli_fetch_array($query)) { ?>
                                <option value="<?php echo $row['ID']; ?>">
                                    <?php echo $row['NAMA'] ?></option>
                            <?php } ?>
                            <option value="3">Tim Tapis Barang</option>
                        <?php }
                        ?>
                    </select>
                    <!-- <input type="radio" id="direksi" name="forward" value="direksi" required>
                <label for="direksi">
                    <h6>Direksi</h6>
                </label><br>
                <input type="radio" id="ttb" name="forward" value="ttb" required>
                <label for="ttb">
                    <h6>Tim Tapis Barang</h6>
                </label><br> -->
                </div>
                <div class="text-center">
                    <button type='submit' id='submit' class="btn btn-primary larger">Submit</button>
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
    function view(idmemo) {
        $("#myModal").modal("show");
        var user_id = <?php echo $user_id ?>;
        document.getElementById("submit").onclick = (function() {
            document.getElementById('submit').setAttribute("disabled", "disabled");
            // var forward = $("[name='forward']:checked").val();
            var forward = $("#forward").val();
            $.ajax({
                url: 'memoForward.php',
                type: 'POST',
                data: {
                    idmemo: idmemo,
                    user_id: user_id,
                    forward: forward
                },
                dataType: 'html',
                success: function(data) {
                    // if (!$('input[name=forward]:checked').val()) {
                    //     alert("Pilih Terlebih Dahulu!");
                    // } else {
                    //     location.reload();
                    // }
                    location.reload();
                    console.log(data);
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