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
                            <div class="form-inline mb-2">
                                <form action="assetList_pemeliharaan.php" method="POST">
                                    <select class="form-control" name="unit" id="unit" style="width: fit-content;">
                                        <?php
                                        $sql = "SELECT ID, NAMA FROM unit WHERE AKTIF = 1 AND MANAJERIAL = 0;";
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
                                    <button class="btn btn-primary larger" type='submit' name='submit'>Pilih</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>RUANG</th>
                                            <th>KONDISI</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $unit = $_POST['unit'];
                                            $submit = $_POST['submit'];
                                            $sql = "CALL assetList_pemeliharaan(" . $unit . ");";
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
                                                            <td style='text-align:center;'>" . $no . "</td>
                                                            <td>$data[KODE]</td>
                                                            <td>$data[nama]</td>
                                                            <td style='display:none'>$data[jenis]</td>
                                                            <td>$data[kategori]</td>
                                                            <td>$data[golongan]</td>
                                                            <td>$data[ruang]</td>
                                                            <td>$data[kondisi]</td>
                                                            <td class='text-center'><button class='btn bg-transparent' onclick=maintenance($data[ASET_ID],$data[DEPRESI_ID],$data[UNIT_ID],$data[RUANG_ID])><img width='30px' height='30px' src='../../assets/svg/view.svg'></button></td>
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
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KETERANGAN</th>
                                            <th>BIAYA</th>
                                            <th>UNIT</th>
                                            <th>STATUS</th>
                                            <th>HAPUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $unit = $_POST['unit'];
                                            $submit = $_POST['submit'];
                                            $sql = "CALL assetList_pemeliharaan(" . $unit . ");";
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
                                                            <td class='text-right'>" . rupiah($data['biaya']) . "</td>
                                                            <td>$data[unit]</td>
                                                            <td class='text-center'>$status</td>
                                                            <td class='text-center'><button class='btn bg-transparent' onclick=hapus($data[ID])><img width='30px' height='30px' src='../../assets/svg/hapus.svg'></button></td>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="color:black">
            <div class="modal-header">
                <a class="modal-title h5"><u>Form Pemeliharaan</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body align-self-center">
                <table class="m-0" id='pemeliharaan'>
                    <tr>
                        <td style='text-align: right; border-top: none;'>Keterangan : </td>
                        <td style="border-top: none;"><textarea id='ket' style='width:300px'></textarea></td>
                    </tr>
                    <tr>
                        <td style='text-align: right'>Biaya : </td>
                        <td><input type="text" class="inputView" id='biaya' autocomplete="off"></td>
                    </tr>
                </table>
                <div class="text-center">
                    <button type='submit' id='submitMaint' class="btn btn-primary larger mt-3">Submit</button>
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
    function maintenance(asetid, depreid, unitid, ruangid) {
        $("#myModal").modal("show");
        document.getElementById("submitMaint").onclick = (function() {
            var user_id = "<?php echo $user_id ?>";
            var privilege_id = "<?php echo $privilege_id ?>";
            var ket = $("#ket").val();
            var biaya2 = $("#biaya").val();
            var biaya = biaya2.replace(/[^,\d]/g, "");
            $.ajax({
                url: 'createMemo_ips.php',
                type: 'POST',
                data: {
                    asetid: asetid,
                    depreid: depreid,
                    unitid: unitid,
                    ruangid: ruangid,
                    ket: ket,
                    biaya: biaya,
                    user_id: user_id,
                    privilege_id: privilege_id
                },
                dataType: 'html',
                success: function(data) {
                    location.reload();
                    // console.log(data);
                }
            });
        });
    }

    function hapus(memoid) {
        $("#myModal2").modal("show");
        document.getElementById("delete").onclick = (function() {
            $.ajax({
                url: 'deleteMemo_ips.php',
                type: 'POST',
                data: {
                    memoid: memoid
                },
                dataType: 'html',
                success: function(data) {
                    location.reload();
                    // console.log(data);
                }
            });
        });
    }

    var rupiah = document.getElementById("biaya");
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
</script>
</body>

</html>