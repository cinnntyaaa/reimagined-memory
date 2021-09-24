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
                                <hr data-content="MEMO LELANG TEREKOMENDASI" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <!-- <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>TANGGAL BELI</th>
                                            <th>HARGA BELI</th>
                                            <th>NILAI</th> -->
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL lelangRekom_list()";
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
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='align-middle'>$data[KODE]</td>
                                                    <td class='align-middle'>$data[NAMA]</td>
                                                    <td class='d-none'>$data[jenis]</td>
                                                    <td class='d-none'>$data[kategori]</td>
                                                    <td class='d-none'>$data[golongan]</td>
                                                    <td class='d-none'>$data[tgl_beli]</td>
                                                    <td class='d-none'>" . rupiah($data['harga_beli']) . "</td>
                                                    <td class='d-none'>" . rupiah($data['nilai']) . "</td>
                                                    <td class='text-center align-middle'><button class='btn bg-transparent' onclick=view($data[ASET_ID])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Kategori :</td>
                                                    <td colspan=3>$data[kategori]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Golongan :</td>
                                                    <td colspan=3>$data[golongan]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Tgl Beli :</td>
                                                    <td colspan=3>$data[tgl_beli]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Harga Beli :</td>
                                                    <td colspan=3>" . rupiah($data['harga_beli']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Nilai :</td>
                                                    <td colspan=3>" . rupiah($data['nilai']) . "</td>
                                                </tr>";
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="MEMO LELANG TERAJUKAN" class="hr-text">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <!-- <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>TANGGAL BELI</th>
                                            <th>HARGA BELI</th>
                                            <th>NILAI</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL lelangRekom_list()";
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
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='align-middle'>$data[KODE]</td>
                                                    <td class='align-middle'>$data[NAMA]</td>
                                                    <td class='d-none'>$data[jenis]</td>
                                                    <td class='d-none'>$data[kategori]</td>
                                                    <td class='d-none'>$data[golongan]</td>
                                                    <td class='d-none'>$data[tgl_beli]</td>
                                                    <td class='d-none'>" . rupiah($data['harga_beli']) . "</td>
                                                    <td class='d-none'>" . rupiah($data['nilai']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Kategori :</td>
                                                    <td colspan=2>$data[kategori]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Golongan :</td>
                                                    <td colspan=2>$data[golongan]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Tgl Beli :</td>
                                                    <td colspan=2>$data[tgl_beli]</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Harga Beli :</td>
                                                    <td colspan=2>" . rupiah($data['harga_beli']) . "</td>
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Nilai :</td>
                                                    <td colspan=2>" . rupiah($data['nilai']) . "</td>
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
                <a class="modal-title h4"><u>Form Disposisi Lelang</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="h5">
                    <label>Keterangan :</label>
                    <textarea type="text" class="form-control" style="height: 150px;" name="ket" id="ket"></textarea>
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
    function view(asetid) {
        $("#myModal").modal("show");
        document.getElementById("submit").onclick = (function() {
            document.getElementById('submit').setAttribute("disabled", "disabled");
            var user_id = "<?php echo $user_id ?>";
            var ket = $("#ket").val();
            $.ajax({
                url: 'createResponseLelang_inventaris.php',
                type: 'POST',
                data: {
                    asetid: asetid,
                    user_id: user_id,
                    ket: ket
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