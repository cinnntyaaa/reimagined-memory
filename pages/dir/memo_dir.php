<?php include("../unit/template/atas.php"); ?>
<style>
    fieldset {
        display: none
    }

    fieldset.show {
        display: block
    }

    select:focus,
    input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer
    }

    .tabs:hover,
    .tabs.active {
        border-bottom: 1px solid #2196F3
    }

    a:hover {
        text-decoration: none;
        color: #1565C0
    }

    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px
    }

    .modal-backdrop {
        background-color: #64B5F6
    }

    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%
    }

    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px
        }
    }
</style>
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
                                            <th>JUDUL</th>
                                            <th>PEMOHON</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_direksi(" . $user_id . ")";
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
                                                $harga_rekom = ($data['harga_rekom'] == "-" ? '-' : rupiah($data['harga_rekom']));
                                                if ($data['attach_rekom'] == "") {
                                                    $attach = "-";
                                                } else {
                                                    $attach = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran'</a>";
                                                }
                                                echo "
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='align-middle text-center'>" . $no . "</td>
                                                    <td class='align-middle'>$data[tgl_memo]</td>
                                                    <td class='align-middle'>$data[JUDUL]</td>
                                                    <td class='align-middle'>$data[pemohon]</td>
                                                    <td class='align-middle text-center'><button class='btn bg-transparent' onclick=view($data[idmemo])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Kode Memo :</td>
                                                    <td colspan=3>$data[KODE]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td  colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Latar Belakang :</td>
                                                    <td colspan=3>$data[latar_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Biaya :</td>
                                                    <td colspan=3>" . rupiah($data['harga_memo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Jumlah :</td>
                                                    <td colspan=3>$data[qty_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Unit :</td>
                                                    <td colspan=3>$data[unit]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Ruang :</td>
                                                    <td colspan=3>$data[ruang]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Lampiran File :</td>
                                                    <td colspan=3>$attach</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Harga Rekomendasi :</td>
                                                    <td colspan=3>$harga_rekom</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan Rekomendasi :</td>
                                                    <td colspan=3>$data[KET_REKOM]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan Forward :</td>
                                                    <td colspan=3>$data[KET_FORWARD]</td>
                                                </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>JUDUL</th>
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_direksi (" . $user_id . ")";
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
                                                if ($data['attach_rekom'] == "") {
                                                    $attach2 = "-";
                                                } else {
                                                    $attach2 = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran'</a>";
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
                                                echo "
                                                   <tr class='parent' id=" . $no . ">
                                                   <td style='text-align:center;'>$no</td>
                                                   <td>$data[tgl_memo]</td>
                                                   <td>$data[JUDUL]</td>
                                                   <td>$data[pemohon]</td>
                                                   <td>$data[unit]</td>
                                                   <td class='text-center'>" . $status . "</td>
                                                   </tr>
                                                   <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=4>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Kode Memo :</td>
                                                    <td colspan=4>$data[KODE]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td  colspan=2>Keterangan :</td>
                                                    <td colspan=4>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Latar Belakang :</td>
                                                    <td colspan=4>$data[latar_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Biaya :</td>
                                                    <td colspan=4>" . rupiah($data['harga_memo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Jumlah :</td>
                                                    <td colspan=4>$data[qty_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Unit :</td>
                                                    <td colspan=4>$data[unit]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Lampiran File :</td>
                                                    <td colspan=4>$attach2</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Disposisi :</td>
                                                    <td colspan=4>$data[disposisi]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Biaya Disposisi :</td>
                                                    <td colspan=4>" . rupiah($data['biaya_dispo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Jumlah Disposisi :</td>
                                                    <td colspan=4>$data[qty_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Tanggal Disposisi :</td>
                                                    <td colspan=4>$data[tgl_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>PIC :</td>
                                                    <td colspan=4>$data[unit_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Tanggal Selesai :</td>
                                                    <td colspan=4>$data[tgl_done]</td>
                                                </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>JUDUL</th>
                                            <th>PEMOHON</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_direksi(" . $user_id . ")";
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
                                            foreach ($outp[2] as $data) {
                                                $harga_rekom = ($data['harga_rekom'] == "-" ? '-' : rupiah($data['harga_rekom']));
                                                if ($data['attach_rekom'] == "") {
                                                    $attach = "-";
                                                } else {
                                                    $attach = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran'</a>";
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
                                                echo "
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='align-middle text-center'>" . $no . "</td>
                                                    <td class='align-middle'>$data[tgl_memo]</td>
                                                    <td class='align-middle'>$data[JUDUL]</td>
                                                    <td class='align-middle'>$data[pemohon]</td>
                                                    <td class='align-middle text-center'>$status</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Kode Memo :</td>
                                                    <td colspan=3>$data[KODE]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td  colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[KETERANGAN]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Latar Belakang :</td>
                                                    <td colspan=3>$data[latar_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Biaya :</td>
                                                    <td colspan=3>" . rupiah($data['harga_memo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Jumlah :</td>
                                                    <td colspan=3>$data[qty_memo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Unit :</td>
                                                    <td colspan=3>$data[unit]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Ruang :</td>
                                                    <td colspan=3>$data[ruang]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Lampiran File :</td>
                                                    <td colspan=3>$attach</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Harga Rekomendasi :</td>
                                                    <td colspan=3>$harga_rekom</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan Rekomendasi :</td>
                                                    <td colspan=3>$data[KET_REKOM]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none; background-color:#51F34C'>
                                                    <td colspan=2>Keterangan Forward :</td>
                                                    <td colspan=3>$data[KET_FORWARD]</td>
                                                </tr>
                                                ";
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
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class="tabs active" id="tab01">
                    <h6>Process</h6>
                </div>
                <div class="tabs" id="tab02">
                    <h6 class="font-weight-bold text-muted">Forward</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="line"></div>
            <div class="modal-body p-0">
                <fieldset class="show" id="tab011">
                    <div class="bg-light" id="memoView">

                    </div>
                </fieldset>
                <fieldset id="tab021">
                    <div class="bg-light">
                        <table class='table table-sm h6'>
                            <tr>
                                <td class='align-middle text-right'>Forward Ke : </td>
                                <td class='align-middle'>
                                    <select class="form-control" id="forward" style="width: fit-content;">
                                        <?php
                                        $sql = "SELECT ID, NAMA FROM `user` WHERE PRIVILEGE_ID = 4 AND ID != 4;";
                                        $query = mysqli_query($conn, $sql);
                                        ?>
                                        <?php if (mysqli_num_rows($query) > 0) { ?>
                                            <?php while ($row = mysqli_fetch_array($query)) { ?>
                                                <option value="<?php echo $row['ID']; ?>">
                                                    <?php echo $row['NAMA'] ?></option>
                                            <?php } ?>
                                        <?php }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class='align-middle text-right'>Keterangan : </td>
                                <td class='align-middle'><textarea rows='3' id='ketForward' style='width:325px'></textarea></td>
                            </tr>
                        </table>
                        <div class='text-center mb-2 bg-light'>
                            <button class='btn btn-primary larger' type='submit' id='submit2'>Submit</button>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="line"></div>
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
        var user_id = "<?php echo $user_id ?>";
        $.ajax({
            url: 'proses_memoView.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                user_id: user_id
            },
            dataType: 'html',
            success: function(data) {
                $("#myModal").modal("show");
                $("#memoView").html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        document.getElementById("submit2").onclick = (function() {
            var ketForward = $("#ketForward").val();
            var forward = $("#forward").val();
            $.ajax({
                url: 'memoResponse_direksiForward.php',
                type: 'POST',
                data: {
                    idmemo: idmemo,
                    user_id: user_id,
                    forward: forward,
                    ketForward: ketForward
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

        $(".tabs").click(function() {

            $(".tabs").removeClass("active");
            $(".tabs h6").removeClass("font-weight-bold");
            $(".tabs h6").addClass("text-muted");
            $(this).children("h6").removeClass("text-muted");
            $(this).children("h6").addClass("font-weight-bold");
            $(this).addClass("active");

            current_fs = $(".active");

            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "1";

            $("fieldset").removeClass("show");
            $(next_fs).addClass("show");

            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

    });
    $(document).ready(function() {
        var $table = $('#myTable');
        $('tr.parent')
            .css("cursor", "pointer")
            .attr("title", "Click to expand/collapse")
            .click(function() {
                $(this).siblings('.child-' + this.id).toggle();
            });
        // $('tr[@class^=child-]').hide().children('td');

        // var $table = $('#myTable');

        // $table.on('expand-row.bs.table', function(e, index, row, $detail) {
        //     var res = $(".child" + (index + 1)).html();
        //     $detail.html(res);
        // });
    });
</script>
</body>

</html>