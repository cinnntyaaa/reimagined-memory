<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Laporan Memo Depresiasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Laporan Depresiasi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="reportDepresiasi_keu.php" class="form-inline mb-3">
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
                                <hr data-content="LAPORAN ASET TERDEPRESIASI" class="hr-text">
                                <table class="table table-bordered table-md" style="font-size:105%">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>KODE</th>
                                            <th>NAMA</th>
                                            <!-- <th>NOMOR SERI</th> -->
                                            <th>HARGA</th>
                                            <th>TAHUN EFEKTIF</th>
                                            <th>NILAI SUSUT</th>
                                            <!-- <th>KATEGORI</th>
                                            <th>GOLONGAN</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $no = 1;
                                            $sql = "CALL reportDepresiasi_akutansi('" . $tgl_awal . "','" . $tgl_akhir . "')";
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
                                                        <td style='text-align:center;'>" . $no . "</td>
                                                        <td>$data[TANGGAL]</td>
                                                        <td>$data[KODE]</td>
                                                        <td>$data[NAMA]</td>
                                                        <td class='d-none'>$data[NOMOR_SERI]</td>
                                                        <td class='text-right'>" . rupiah($data['harga']) . "</td>
                                                        <td>$data[thn_efektif]</td>
                                                        <td>$data[susut]</td>
                                                        <td class='d-none'>$data[kategori]</td>
                                                        <td class='d-none'>$data[golongan]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Nomor Seri :</td>
                                                        <td colspan=5>$data[NOMOR_SERI]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Kategori :</td>
                                                        <td colspan=5>$data[kategori]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Golongan :</td>
                                                        <td colspan=5>$data[golongan]</td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <hr data-content="LAPORAN NON ASET" class="hr-text">
                                <table class="table table-bordered table-md" style="font-size: 105%;">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>NAMA</th>
                                            <!-- <th>NOMOR SERI</th> -->
                                            <th>HARGA</th>
                                            <th>TAHUN EFEKTIF</th>
                                            <th>NILAI SUSUT</th>
                                            <!-- <th>KATEGORI</th>
                                            <th>GOLONGAN</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $no = 1;
                                            $tgl_awal = $_POST['tgl_awal'];
                                            $tgl_akhir = $_POST['tgl_akhir'];
                                            $submit = $_POST['submit'];
                                            $no = 1;
                                            $sql = "CALL reportDepresiasi_akutansi('" . $tgl_awal . "','" . $tgl_akhir . "')";
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
                                                        <td class='align-middle'>$data[TANGGAL]</td>
                                                        <td class='align-middle'>$data[NAMA]</td>
                                                        <td class='d-none'>$data[NOMOR_SERI]</td>
                                                        <td class='text-right align-middle'>" . rupiah($data['harga']) . "</td>
                                                        <td class='align-middle'>$data[thn_efektif]</td>
                                                        <td class='align-middle'>$data[susut]</td>
                                                        <td class='d-none'>$data[kategori]</td>
                                                        <td class='d-none'>$data[golongan]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Nomor Seri :</td>
                                                        <td colspan=5>$data[NOMOR_SERI]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Kategori :</td>
                                                        <td colspan=5>$data[kategori]</td>
                                                    </tr>
                                                    <tr class='child-" . $no . "' style='display: none;'>
                                                        <td colspan=2>Golongan :</td>
                                                        <td colspan=5>$data[golongan]</td>
                                                    </tr>";
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