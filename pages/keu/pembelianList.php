<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Depresiasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Depresiasi</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Memo Depresiasi</h2>
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
                                            <th>TANGGAL</th>
                                            <th>NAMA</th>
                                            <th>NOMOR SERI</th>
                                            <th>HARGA</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL pembelianList()";
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
                                                    <td>$data[TANGGAL]</td>
                                                    <td>$data[NAMA]</td>
                                                    <td>$data[NOMOR_SERI]</td>
                                                    <td class='text-right'>" . rupiah($data['harga']) . "</td>
                                                    <td class='text-center'>
                                                        <button class='btn bg-transparent' onclick=view($data[idbeli],$data[dispoid],$data[memoid])><img width='30px' height='30px' src='../../assets/svg/view.svg'></button>
                                                    </td>
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
                                            <th>TANGGAL</th>
                                            <th>NAMA</th>
                                            <th>NOMOR SERI</th>
                                            <th>HARGA</th>
                                            <th>TAHUN EFEKTIF</th>
                                            <th>SUSUT</th>
                                            <th>HAPUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL pembelianList()";
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
                                                  <td>$data[TANGGAL]</td>
                                                  <td>$data[NAMA]</td>
                                                  <td>$data[NOMOR_SERI]</td>
                                                  <td class='text-right'>" . rupiah($data['harga']) . "</td>
                                                  <td>$data[thn_efektif]</td>
                                                  <td>$data[susut]</td>
                                                  <td class='text-center'>
                                                    <button class='btn bg-transparent' onclick=hapus($data[idbeli],$data[dispoid],$data[memoid],$data[depresiasi_id],$data[label])><img width='30px' src='../../assets/svg/hapus.svg'></button>
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
                <a class="modal-title h5"><u>Form Depresiasi</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body align-self-center">
                <table class="table m-0" id='depres'>
                    <tr>
                        <td style='text-align: right; border-top:none;'>Tahun Efektif : </td>
                        <td style='border-top:none;'><input class='inputView' id='tahun' autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td style='text-align: right'>Nilai Susut : </td>
                        <td><span id='nilai_susut' autocomplete="off"></span></td>
                    </tr>
                    <tr style="display: none;">
                        <td style='text-align: right'>Jenis : </td>
                        <td><select id='jenis'>
                                ";
                                ?>
                                <?php
                                $sql = "SELECT * FROM jenis;";
                                $query = mysqli_query($conn, $sql);
                                ?>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                                        <option value="<?php echo $row['ID']; ?>">
                                            <?php echo $row['NAMA'] ?></option>
                                    <?php } ?>
                                <?php }
                                echo "
                </select></td></tr>
                <tr>
                    <td style='text-align: right'>Kategori : </td>
                    <td><select id='kategori'>
                ";
                                ?>
                                <?php
                                $sql = "SELECT * FROM kategori;";
                                $query = mysqli_query($conn, $sql);
                                ?>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                                        <option value="<?php echo $row['ID']; ?>">
                                            <?php echo $row['NAMA'] ?></option>
                                    <?php } ?>
                                <?php }
                                echo "
                </select></td></tr>
                <tr>
                    <td style='text-align: right'>Golongan : </td>
                    <td><select id='gol'>
                ";
                                ?>
                                <?php
                                $sql = "SELECT * FROM golongan;";
                                $query = mysqli_query($conn, $sql);
                                ?>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                                        <option value="<?php echo $row['ID']; ?>">
                                            <?php echo $row['NAMA'] ?></option>
                                    <?php } ?>
                                <?php }
                                echo "
                </select></td></tr>
                <tr>
                    <td style='text-align: right'>Tipe : </td>
                    <td>
                        <select id='tipe'>
                            <option value='1'>ASET</option>
                            <option value='2'>NON - ASET</option>
                        </select>
                    </td>
                </tr>                
            </table>
            <div class='text-center'>
            <button type='submit' id='submit' class='btn btn-primary larger'>Submit</button>
            </div>
            ";
                                ?>
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
    function view(idbeli, id_dispo, idmemo) {
        $("#myModal").modal("show");
        $(document).ready(function() {
            $('#tahun').keyup(function(event) {
                var tahun = isNaN(Number($('#tahun').val())) ? 0 : Number($('#tahun').val());
                var hasilAkhir = 100 / tahun;
                $('#nilai_susut').text(hasilAkhir);
            });

        });
        document.getElementById("submit").onclick = (function() {
            var tahun = $("#tahun").val();
            var nisut = $("#nilai_susut").text();
            var jenis = $("#jenis").val();
            var kategori = $("#kategori").val();
            var gol = $("#gol").val();
            var tipe = $("#tipe").val();
            console.log(tahun, nisut, idbeli, id_dispo, idmemo, jenis, kategori, gol, tipe);
            $.ajax({
                url: 'createDepresiasi.php',
                type: 'POST',
                data: {
                    idbeli: idbeli,
                    id_dispo: id_dispo,
                    idmemo: idmemo,
                    tahun: tahun,
                    nisut: nisut,
                    jenis: jenis,
                    gol: gol,
                    kategori: kategori,
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

    function hapus(id_beli, dispoid, memoid, depresi, label) {
        $("#myModal2").modal("show");
        document.getElementById("delete").onclick = (function() {
            $.ajax({
                url: 'deleteDepresiasi.php',
                type: 'POST',
                data: {
                    id_beli: id_beli,
                    dispoid: dispoid,
                    memoid: memoid,
                    depresi: depresi,
                    label: label
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