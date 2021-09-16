<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Laporan Pemeliharaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Pemeliharaan</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Laporan Pemeliharaan Aset</h2>
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
                                            <th>UNIT</th>
                                            <th>RUANG</th>
                                            <th>KONDISI</th>
                                            <th>LAST CHECK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL reportPemeliharaan_ips()";
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
                                                <td>$data[kode]</td>
                                                <td>$data[nama]</td>
                                                <td>$data[unit]</td>
                                                <td>$data[ruang]</td>
                                                <td>$data[kondisi]</td>
                                                <td>$data[last_check]</td>
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
                                            <th>UNIT</th>
                                            <th>RUANG</th>
                                            <th>KONDISI</th>
                                            <th>LAST CHECK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL reportPemeliharaan_ips()";
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
                                                <td style='text-align:center;'>$no</td>
                                                <td>$data[kode]</td>
                                                <td>$data[nama]</td>
                                                <td>$data[unit]</td>
                                                <td>$data[ruang]</td>
                                                <td>$data[kondisi]</td>
                                                <td>$data[last_check]</td>
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
<?php
include("../unit/template/bawah.php");
?>

</body>

</html>