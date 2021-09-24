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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <hr data-content="MEMO PEMELIHARAAN YANG TEREKOMENDASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <!-- <th>KODE</th> -->
                                            <th>NAMA</th>
                                            <!-- <th>KETERANGAN</th>
                                            <th>BIAYA</th> -->
                                            <th>UNIT</th>
                                            <!-- <th>KETERANGAN DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th> -->
                                            <th>STATUS</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL dispoBettermentList_inventaris(" . $user_id . "," . $unit_id . ")";
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
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='d-none'>$data[kode]</td>
                                                    <td class='align-middle'>$data[nama]</td>
                                                    <td class='d-none'>$data[keterangan]</td>
                                                    <td class='d-none'>" . rupiah($data['biaya_memo']) . "</td>
                                                    <td class='align-middle'>$data[unit]</td>
                                                    <td class='d-none'>$data[ket_dispo]</td>
                                                    <td class='d-none'>" . rupiah($data['biaya_dispo']) . "</td>
                                                    <td class='text-center align-middle'>$status</td>
                                                    <td class='text-center align-middle'><button class='btn bg-transparent' onclick=view($data[memo_id],$data[aset_id],$data[UNIT_ID],$data[DEPRESI_ID])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Kode :</td>
                                                    <td colspan=3>$data[kode]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[keterangan]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Biaya :</td>
                                                    <td colspan=3>" . rupiah($data['biaya_memo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Disposisi :</td>
                                                    <td colspan=3>$data[ket_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Biaya Disposisi :</td>
                                                    <td colspan=3>" . rupiah($data['biaya_dispo']) . "</td>
                                                </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="MEMO PEMELIHARAAN YANG TERAJUKAN" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <!-- <th>KODE</th> -->
                                            <th>NAMA</th>
                                            <!-- <th>KETERANGAN</th> -->
                                            <th>UNIT</th>
                                            <!-- <th>KETERANGAN DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>KETERANGAN BELI</th>
                                            <th>BIAYA BELI</th> -->
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL dispoBettermentList_inventaris(" . $user_id . "," . $unit_id . ")";
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
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='d-none'>$data[kode]</td>
                                                    <td class='align-middle'>$data[nama]</td>
                                                    <td class='d-none'>$data[keterangan]</td>
                                                    <td class='align-middle'>$data[unit]</td>
                                                    <td class='d-none'>$data[ket_dispo]</td>
                                                    <td class='d-none'>" . rupiah($data['biaya_dispo']) . "</td>
                                                    <td class='d-none'>$data[ket_beli]</td>
                                                    <td class='d-none'>" . rupiah($data['biaya_beli']) . "</td>
                                                    <td class='text-center align-middle'>$status</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Kode :</td>
                                                    <td colspan=3>$data[kode]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Latar Belakang :</td>
                                                    <td colspan=3>$data[keterangan]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Disposisi :</td>
                                                    <td colspan=3>$data[ket_dispo]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Biaya Disposisi :</td>
                                                    <td colspan=3>" . rupiah($data['biaya_dispo']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Keterangan :</td>
                                                    <td colspan=3>$data[ket_beli]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td colspan=2>Biaya Pemeliharaan :</td>
                                                    <td colspan=3>" . rupiah($data['biaya_beli']) . "</td>
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
                <a class="modal-title h4"><u>Form Disposisi Memo Pemeliharaan</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <div class="h5">
                    <label>Biaya :</label>
                    <input type="text" class="inputView" id='harga' autocomplete="off"><br><br>
                    <label>Keterangan :</label>
                    <textarea type="text" class="form-control" style="height: 200px;" name="ket" id="ket"></textarea>
                </div>
                <div class="text-center">
                    <button class='btn btn-primary larger' type='submit' id="submit">Submit</button>
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
    function view(idmemo, idaset, idunit, depreid) {
        $("#myModal").modal("show");
        document.getElementById("submit").onclick = (function() {
            document.getElementById('submit').setAttribute("disabled", "disabled");
            var ket = $("#ket").val();
            var harga2 = $("#harga").val();
            var harga = harga2.replace(/[^,\d]/g, "");
            var user_id = "<?php echo $user_id ?>";
            $.ajax({
                url: 'createApresiasi.php',
                type: 'POST',
                data: {
                    idmemo: idmemo,
                    idaset: idaset,
                    idunit: idunit,
                    depreid: depreid,
                    ket: ket,
                    harga: harga,
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
        })
    }

    var rupiah = document.getElementById("harga");
    rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
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