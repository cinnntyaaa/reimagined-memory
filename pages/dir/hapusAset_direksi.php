<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Penghapusan Aset</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Penghapusan</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Memo Penghapusan Aset</h2>
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
                                        $sql = "CALL hapusDispo_list()";
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
                                              <td class='text-right'>" . rupiah($data['harga_beli']) . "</td>
                                              <td class='text-right'>" . rupiah($data['nilai']) . "</td>
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
                                        $sql = "CALL hapusDispo_list()";
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
                                              <td class='text-right'>" . rupiah($data['harga_beli']) . "</td>
                                              <td class='text-right'>" . rupiah($data['nilai']) . "</td>
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
                <a class="modal-title h5"><u>Form Penghapusan Aset</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body align-self-center">
                <table class="table" style="font-size: medium">
                    <tr>
                        <td style='text-align: right'>Keterangan : </td>
                        <td><textarea id='ket' style='width:300px'></textarea></td>
                    </tr>
                </table>
                <div class="text-center">
                    <button class='btn btn-sm bg-tomato text-white' type='submit' id="submit">Submit</button>
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
            var user_id = "<?php echo $user_id ?>";
            var ket = $("#ket").val();
            $.ajax({
                url: 'createDispoHapus_direksi.php',
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
</script>
</body>

</html>