<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Mutasi Aset Tetap</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Mutasi</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Mutasi Aset</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Mutasi Aset Tetap</h2>
            <p class="section-lead m-4">
                <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-inline mb-3">
                                    <form action="mutasiList_inventaris.php" method="POST">
                                        <select class="form-control" name="unit" style="width: fit-content;">
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
                                        <button class="btn btn-primary larger" type='submit' name='submit'>Submit</button>
                                    </form>
                                </div>
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
                                            $sql = "CALL mutasiList_inventaris(" . $unit . ");";
                                            $outp = array();
                                            if (mysqli_multi_query($conn, $sql)) {
                                                do {
                                                    // Store first result set
                                                    if ($result = mysqli_store_result($conn)) {
                                                        $outp = $result->fetch_all(MYSQLI_ASSOC);
                                                        // Fetch one and one row
                                                    }
                                                } while (mysqli_next_result($conn));
                                                foreach ($outp as $data) {
                                                    echo "
                                                        <tr>
                                                            <td style='text-align:center;'>" . $no . "</td>
                                                            <td>$data[KODE]</td>
                                                            <td>$data[nama]</td>
                                                            <td>$data[kategori]</td>
                                                            <td>$data[golongan]</td>
                                                            <td>$data[ruang]</td>
                                                            <td>$data[kondisi]</td>
                                                            <td class='text-center'><button class='btn bg-transparent' onclick=mutasi($data[ASET_ID])><img width='30px' src='../../assets/svg/mutasi.svg'></button></td>
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
                <a class="modal-title h5"><u>Form Mutasi Tetap</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body align-self-center">
                <a class="modal-title h5">Dimutasi Ke :</a>
                <table class="table m-0 h6">
                    <tr id="filter1">
                        <td style="border-top: none;">Unit</td>
                        <td style="border-top: none;"><select name="unitMutasi" id="unitMutasi" style="width: fit-content;">
                                <option>Pilih Unit</option>
                                <?php
                                $sql = "SELECT ID, NAMA FROM unit WHERE AKTIF = 1 AND MANAJERIAL = 0 AND ID != $unit ;";
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
                        <td>Ruang</td>
                        <td><select name="ruangMutasi" id="ruangMutasi" style="width: fit-content;" required>

                            </select>
                        </td>
                    </tr>
                </table>
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
    function mutasi(asetid) {
        $("#myModal").modal("show");
        $(document).ready(function() {
            $('#unitMutasi').change(function() {
                // var filter1 = $(this).val();
                var unitChoice = $("#unitMutasi").val();
                $.ajax({
                    type: 'POST',
                    url: 'filterRuang.php',
                    data: {
                        unitChoice
                    },
                    success: function(response) {
                        $('#ruangMutasi').html(response);
                    }
                });
            });
        });
        document.getElementById("submit").onclick = (function() {
            var userid = "<?php echo $user_id ?>";
            var unitMutasi = $("#unitMutasi").val();
            var ruangMutasi = $("#ruangMutasi").val();
            $.ajax({
                url: 'createMutasi_inventaris.php',
                type: 'POST',
                data: {
                    asetid: asetid,
                    unitMutasi: unitMutasi,
                    ruangMutasi: ruangMutasi,
                    userid: userid
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