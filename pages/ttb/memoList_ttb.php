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
            <h2 class="section-title">Memo Pengadaan</h2>
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
                                            <th>JUDUL</th>
                                            <th>KETERANGAN</th>
                                            <th>LATAR BELAKANG</th>
                                            <th>ATTACHMENT</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th>
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <th>UNTUK</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_ttb()";
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
                                                    <tr>
                                                    <td style='text-align:center;'>" . $no . "</td>
                                                    <td>$data[KODE]</td>
                                                    <td>$data[JUDUL]</td>
                                                    <td>$data[KETERANGAN]</td>
                                                    <td>$data[latar_memo]</td>
                                                    <td>$attach</td>
                                                    <td class='text-right'>" . rupiah($data['harga_memo']) . "</td>
                                                    <td class='text-right'>$data[qty_memo]</td>
                                                    <td>$data[pemohon]</td>
                                                    <td>$data[unit]</td>
                                                    <td>$data[untuk]</td>
                                                    <td class='text-center'><button class='btn bg-transparent' onclick=view($data[idmemo])><img width='30px' src='../../assets/svg/view.svg'></button></td>
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
                                            <th>JUDUL</th>
                                            <th>KETERANGAN</th>
                                            <th>LATAR BELAKANG</th>
                                            <th>ATTACHMENT</th>
                                            <th>ATTACHMENT REKOM</th>
                                            <th>BIAYA</th>
                                            <th>JUMLAH</th>
                                            <th>PEMOHON</th>
                                            <th>UNIT</th>
                                            <th>UNTUK</th>
                                            <th>STATUS</th>
                                            <th>KETERANGAN REKOM</th>
                                            <th>HARGA REKOM</th>
                                            <th>REKOMENDASI</th>
                                            <th>DISPOSISI</th>
                                            <th>BIAYA DISPOSISI</th>
                                            <th>JUMLAH DISPOSISI</th>
                                            <th>USER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_ttb()";
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
                                                if ($data['attach_rekom'] == "") {
                                                    $attach3 = "-";
                                                } else {
                                                    $attach3 = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran Rekom'</a>";
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
                                                    <tr>
                                                    <td style='text-align:center;'>$no</td>
                                                    <td>$data[KODE]</td>
                                                    <td>$data[JUDUL]</td>
                                                    <td>$data[KETERANGAN]</td>
                                                    <td>$data[latar_memo]</td>
                                                    <td>$attach2</td>
                                                    <td>$attach3</td>
                                                    <td class='text-right'>" . rupiah($data['harga_memo']) . "</td>
                                                    <td class='text-right'>$data[qty_memo]</td>
                                                    <td>$data[pemohon]</td>
                                                    <td>$data[unit]</td>
                                                    <td>$data[untuk]</td>
                                                    <td>$status</td>
                                                    <td>$data[KET_REKOM]</td>
                                                    <td class='text-right'>" . rupiah($data['harga_rekom']) . "</td>
                                                    <td>$data[rekomendasi]</td>
                                                    <td>$data[disposisi]</td>
                                                    <td>$biaya_dispo</td>
                                                    <td>$data[qty_dispo]</td>
                                                    <td>$data[user]</td>
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
                <a class="modal-title h5"><u>Form Rekomendasi Memo Pengadaan</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body h6">
                <label for="harga_rekom">Harga Rekomendasi :</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Rp.</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="harga_rekom" name="harga_rekom" autocomplete="off" required>
                </div>
                <label for="forward">Forward Ke :</label>
                <select class="form-control mb-2" id="forward" style="width: fit-content;">
                    <?php
                    $sql = "SELECT ID, NAMA FROM `user` WHERE PRIVILEGE_ID = 4;";
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
                <label for="ket">Keterangan :</label>
                <textarea type="text" class="form-control mb-2" name="ket" id="ket" rows="4"></textarea>

                <label for="attach">File Attachment</label>
                <div class="input-group mb-2">
                    <!-- <input type="file" class="form-control-file" id="attach" name="berkas"> -->
                    <input type="file" name="fileupload" id='fileupload' />
                </div><br>
                <div class="text-center">
                    <button class='btn btn-primary larger' type='submit' id='submit'>Submit</button>
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
            const fileupload = $('#fileupload').prop('files')[0];
            var harga2 = $("#harga_rekom").val();
            var harga = harga2.replace(/[^,\d]/g, "");
            var ket = $("#ket").val();
            var forward = $("#forward").val();

            if (fileupload != "") {
                let formData = new FormData();
                formData.append('fileupload', fileupload);
                formData.append('harga_rekom', harga);
                formData.append('ket', ket);
                formData.append('forward', forward);
                formData.append('idmemo', idmemo);
                formData.append('user_id', user_id);

                $.ajax({
                    type: 'POST',
                    url: "createRekom.php",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.reload();
                        // console.log(data);
                    },
                    error: function() {
                        alert("Data Gagal Diupload");
                    }
                });
            } else {
                $.ajax({
                    url: 'createRekom.php',
                    type: 'POST',
                    data: {
                        idmemo: idmemo,
                        user_id: user_id,
                        harga: harga,
                        ket: ket,
                        forward: forward
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
            }


        });
    }
    var rupiah = document.getElementById("harga_rekom");
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