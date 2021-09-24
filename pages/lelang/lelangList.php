<?php include("../unit/template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Lelang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Lelang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <hr data-content="MEMO ASET BELUM TERLELANG" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>TANGGAL BELI</th>
                                            <th>HARGA BELI</th>
                                            <th>NILAI</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL lelangList()";
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
                                              <td>$data[NAMA]</td>
                                              <td>$data[kategori]</td>
                                              <td>$data[golongan]</td>
                                              <td>$data[tgl_beli]</td>
                                              <td>" . rupiah($data['harga_beli']) . "</td>
                                              <td>" . rupiah($data['nilai']) . "</td>
                                              <td class='text-center'><button class='btn bg-transparent' onclick=view($data[ASET_ID])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                            </tr> ";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="MEMO ASET TERLELANG" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>TANGGAL BELI</th>
                                            <th>HARGA BELI</th>
                                            <th>NILAI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL lelangList()";
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
                                              <td style='text-align:center;'>" . $no . "</td>
                                              <td>$data[KODE]</td>
                                              <td>$data[NAMA]</td>
                                              <td>$data[kategori]</td>
                                              <td>$data[golongan]</td>
                                              <td>$data[tgl_beli]</td>
                                              <td>" . rupiah($data['harga_beli']) . "</td>
                                              <td>" . rupiah($data['nilai']) . "</td>
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
                <a class="modal-title h4"><u>Form Lelang Aset</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-3">
                <div class="h5">
                    <label>Pilih Kondisi :</label>
                    <select id="kondisi" name="kondisi">
                        <?php
                        $sql = "SELECT ID, NAMA FROM kondisi WHERE ID IN(9,10,11);";
                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                            <?php while ($row = mysqli_fetch_array($query)) { ?>
                                <option value="<?php echo $row['ID']; ?>">
                                    <?php echo $row['NAMA'] ?></option>
                            <?php } ?>
                        <?php }
                        ?>
                    </select><br><br>
                    <label>Harga :</label>
                    <input type="text" class="inputView" id="harga"><br><br>
                    <label>Keterangan :</label>
                    <textarea type="text" class="form-control" style="height: 100px;" name="ket" id="ket"></textarea>
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
    function view(asetid) {
        $("#myModal").modal("show");
        document.getElementById("submit").onclick = (function() {
            document.getElementById('submit').setAttribute("disabled", "disabled");
            var kondisi = $("#kondisi").val();
            var harga2 = $("#harga").val();
            var harga = harga2.replace(/[^,\d]/g, "");
            var ket = $("#ket").val();
            var user_id = "<?php echo $user_id ?>";
            $.ajax({
                url: 'createPawn_lelang.php',
                type: 'POST',
                data: {
                    asetid: asetid,
                    kondisi: kondisi,
                    harga: harga,
                    ket: ket,
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
</script>
</body>

</html>