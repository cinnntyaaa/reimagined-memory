<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Pemeliharaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Pemeliharaan</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Memo Pemeliharaan</h2>
            <p class="section-lead m-4">
                <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KETERANGAN</th>
                                            <th>UNIT</th>
                                            <th>KETERANGAN DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>KETERANGAN BELI</th>
                                            <th>BIAYA BELI</th>
                                            <th>STATUS</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL dispoBettermentList_akutansi(" . $user_id . ", " . $unit_id . ")";
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
                                                if ($data['status'] == 0) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/filter.svg' title='FILTER'>"; #FILTER
                                                } else if ($data['status'] == 1) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/sent.svg' title='SENT'>"; #SENT
                                                } else if ($data['status'] == 2) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/rekom.svg' title='REKOM'>"; #REKOM
                                                } else if ($data['status'] == 3) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/process.svg' title='PROCESS'>"; #PROCESS
                                                } else if ($data['status'] == 4) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/rejected.svg' title='REJECTED'>"; #REJECTED
                                                } else if ($data['status'] == 5) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/approved.svg' title='APPROVED'>"; #APPROVED
                                                } else if ($data['status'] == 6) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/buy_less.svg' title='BUY LESS'>"; #BUY LESS
                                                } else if ($data['status'] == 7) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/buy_complete.svg' title='BUY COMPLETE'>"; #BUY COMPLETE
                                                } else if ($data['status'] == 8) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/eval_less.svg' title='EVAL LESS'>"; #EVAL LESS
                                                } else if ($data['status'] == 9) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/eval_complete.svg' title='EVAL COMPLETE'>"; #EVAL COMPLETE
                                                } else if ($data['status'] == 10) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/done.svg' title='DELIVERED'>"; #DELIVERED
                                                } else if ($data['status'] == 11) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/pending.svg' title='PENDING'>"; #PENDING
                                                } else if ($data['status'] == 12) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/forward.svg' title='FORWARD'>"; #FORWARD
                                                }
                                                echo "
                                                <tr>
                                                  <td style='text-align:center;'>" . $no . "</td>
                                                  <td>$data[kode]</td>
                                                  <td>$data[nama]</td>
                                                  <td>$data[keterangan]</td>
                                                  <td>$data[unit]</td>
                                                  <td>$data[ket_dispo]</td>
                                                  <td class='text-right'>" . rupiah($data['biaya_dispo']) . "</td>
                                                  <td>$data[ket_beli]</td>
                                                  <td class='text-right'>" . rupiah($data['biaya_beli']) . "</td>
                                                  <td class='text-center'>$status</td>
                                                  <td class='text-center'><button class='btn bg-transparent' onclick=view($data[memoid],$data[depresid],$data[apresid])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                </tr> ";
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
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KETERANGAN</th>
                                            <th>UNIT</th>
                                            <th>KETERANGAN DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>KETERANGAN BELI</th>
                                            <th>BIAYA BELI</th>
                                            <th>STATUS</th>
                                            <th>LABEL</th>
                                            <th>HAPUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL dispoBettermentList_akutansi(" . $user_id . ", " . $unit_id . ")";
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
                                                if ($data['status'] == 0) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/filter.svg' title='FILTER'>"; #FILTER
                                                } else if ($data['status'] == 1) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/sent.svg' title='SENT'>"; #SENT
                                                } else if ($data['status'] == 2) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/rekom.svg' title='REKOM'>"; #REKOM
                                                } else if ($data['status'] == 3) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/process.svg' title='PROCESS'>"; #PROCESS
                                                } else if ($data['status'] == 4) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/rejected.svg' title='REJECTED'>"; #REJECTED
                                                } else if ($data['status'] == 5) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/approved.svg' title='APPROVED'>"; #APPROVED
                                                } else if ($data['status'] == 6) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/buy_less.svg' title='BUY LESS'>"; #BUY LESS
                                                } else if ($data['status'] == 7) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/buy_complete.svg' title='BUY COMPLETE'>"; #BUY COMPLETE
                                                } else if ($data['status'] == 8) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/eval_less.svg' title='EVAL LESS'>"; #EVAL LESS
                                                } else if ($data['status'] == 9) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/eval_complete.svg' title='EVAL COMPLETE'>"; #EVAL COMPLETE
                                                } else if ($data['status'] == 10) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/done.svg' title='DELIVERED'>"; #DELIVERED
                                                } else if ($data['status'] == 11) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/pending.svg' title='PENDING'>"; #PENDING
                                                } else if ($data['status'] == 12) {
                                                    $status = "<img width='30px' height='30px' src='../../assets/svg/forward.svg' title='FORWARD'>"; #FORWARD
                                                }
                                                echo "
                                                <tr>
                                                <td style='text-align:center;'>" . $no . "</td>
                                                <td>$data[kode]</td>
                                                <td>$data[nama]</td>
                                                <td>$data[keterangan]</td>
                                                <td>$data[unit]</td>
                                                <td>$data[ket_dispo]</td>
                                                <td class='text-right'>" . rupiah($data['biaya_dispo']) . "</td>
                                                <td>$data[ket_beli]</td>
                                                <td class='text-right'>" . rupiah($data['biaya_beli']) . "</td>
                                                <td class='text-center'>$status</td>
                                                <td>$data[label]</td>
                                                <td class='text-center'>
                                                    <button class='btn bg-transparent' onclick=hapus($data[memo_id],$data[depresi_id],$data[apresiasi_id])><img width='30px' height='30px' src='../../assets/svg/hapus.svg'></button>
                                                  </td>
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
        <div class="modal-content" style="color:black">
            <div class="modal-header">
                <a class="modal-title h5"><u>Form Apresiasi</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center h5">
                Tipe :
                <select id='tipe'>
                    <option value='5'>VALUASI</option>
                    <option value='4'>NON - VALUASI</option>
                </select>
                <div class='text-center'>
                    <button type='submit' id='submit' class='btn btn-primary larger text-white'>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title h5">Hapus Memo</a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h5>Apakah Memo Ini Akan Dihapus?</h5>
                <button type='submit' id='delete' class="btn bg-primary larger">YA</button>
            </div>
        </div>
    </div>
</div>
<?php
include("../unit/template/bawah.php");
?>

<!-- Page Specific JS File -->
<script>
    function view(memoid, depresid, apresid) {
        $("#myModal").modal("show");
        document.getElementById("submit").onclick = (function() {
            var tipe = $("#tipe").val();
            $.ajax({
                url: 'approveApresiasi.php',
                type: 'POST',
                data: {
                    memoid: memoid,
                    depresid: depresid,
                    apresid: apresid,
                    tipe: tipe
                },
                dataType: 'html',
                success: function(data) {
                    location.reload();
                    // console.log(data)
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        });
    }

    function hapus(memo_id, depresi_id, apresiasi_id) {
        $("#myModal2").modal("show");
        document.getElementById("delete").onclick = (function() {
            $.ajax({
                url: 'deleteApresiasi.php',
                type: 'POST',
                data: {
                    memo_id: memo_id,
                    depresi_id: depresi_id,
                    apresiasi_id: apresiasi_id,
                },
                dataType: 'html',
                success: function(data) {
                    location.reload();
                    // console.log(data);
                }
            });
        });
    }
</script>
</body>

</html>