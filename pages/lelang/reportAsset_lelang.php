<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Laporan Aset Lelang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Aset Lelang</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="reportAsset_lelang.php" class="form-inline mb-3">
                                <div class="form-group">
                                    <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                                </div>
                                <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                                <div class="form-group">
                                    <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary p-2 ml-2 larger">Cari</button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <!-- <th>KATEGORI</th>
                                            <th>GOLONGAN</th>
                                            <th>TANGGAL BELI</th>
                                            <th>HARGA BELI</th> -->
                                            <th>HARGA LELANG</th>
                                            <!-- <th>NILAI</th>
                                            <th>KETERANGAN</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $sql = "CALL reportAssetBase_lelang ('" . $tgl_awal . "', '" . $tgl_akhir . "')";
                                            $query = mysqli_query($conn, $sql);
                                            while ($data = mysqli_fetch_array($query)) {
                                                echo "
                                                <tr class='parent' id=" . $no . ">
                                                    <td class='text-center align-middle'>" . $no . "</td>
                                                    <td class='align-middle'>$data[KODE]</td>
                                                    <td class='align-middle'>$data[NAMA]</td>
                                                    <td class='d-none'>$data[kategori]</td>
                                                    <td class='d-none'>$data[golongan]</td>
                                                    <td class='d-none'>$data[tgl_beli]</td>
                                                    <td class='d-none'>" . rupiah($data['harga_beli']) . "</td>
                                                    <td class='align-middle'>" . rupiah($data['harga_lelang']) . "</td>
                                                    <td class='d-none'>" . rupiah($data['nilai']) . "</td>
                                                    <td class='d-none'>$data[KETERANGAN]</td>
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
                                                </tr>
                                                <tr class='child-" . $no . "' style='display: none;'>
                                                    <td>Keterangan :</td>
                                                    <td colspan=3>$data[KETERANGAN]</td>
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
<?php include("../unit/template/bawah.php"); ?>

<!-- Page Specific JS File -->
<script>
    $(function() {
        $("#tgl_awal").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        });
        $("#tgl_akhir").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
        });
    });
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