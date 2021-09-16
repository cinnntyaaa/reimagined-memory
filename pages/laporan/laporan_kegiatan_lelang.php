<?php
session_start();
error_reporting(0);
if (!isset($_SESSION["user"])) {
?>
    <script>
        alert("Silakan Coba Lagi!");
        document.location = 'login.php';
    </script>
<?php
}
if ($_SESSION['privilege_id'] == "6") {
    include("../unit/template/atas.php");
?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header mb-3">
                <h1>Laporan Kegiatan Lelang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Laporan Kegiatan Lelang</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Laporan Kegiatan Lelang</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="laporan_kegiatan_lelang.php" class="form-inline mb-3">
                                    <div class="form-group">
                                        <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                                    </div>
                                    <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                                    <div class="form-group">
                                        <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary larger p-2 ml-1">Cari</button>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>GOLONGAN</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>HARGA LELANG</th>
                                                <th>NILAI</th>
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
                                    <tr>
                                    <td style='text-align:center;'>" . $no . "</td>
                                    <td>$data[KODE]</td>
                                    <td>$data[NAMA]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[golongan]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td>" . rupiah($data['harga_beli']) . "</td>
                                    <td>" . rupiah($data['harga_lelang']) . "</td>
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
        </section>
    </div>
    <?php
    include("../unit/template/bawah.php");
    ?>
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
    </script>
    </body>

    </html>
<?php
} else if ($_SESSION['privilege_id'] == "7") {
    include("../unit/template/atas.php");
?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header mb-3">
                <h1>Laporan Kegiatan Lelang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Laporan Kegiatan Lelang</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Laporan Kegiatan Lelang</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="laporan_kegiatan_lelang.php" class="form-inline mb-3">
                                    <div class="form-group">
                                        <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                                    </div>
                                    <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                                    <div class="form-group">
                                        <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary larger p-2 ml-1">Cari</button>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>GOLONGAN</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>HARGA LELANG</th>
                                                <th>NILAI</th>
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
                                    <tr>
                                    <td style='text-align:center;'>" . $no . "</td>
                                    <td>$data[KODE]</td>
                                    <td>$data[NAMA]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[golongan]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td>" . rupiah($data['harga_beli']) . "</td>
                                    <td>" . rupiah($data['harga_lelang']) . "</td>
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
        </section>
    </div>
    <?php
    include("../unit/template/bawah.php");
    ?>
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
    </script>
    </body>

    </html>
<?php
} else if ($_SESSION['privilege_id'] == "4") {
    include("../unit/template/atas.php");
?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header mb-3">
                <h1>Laporan Kegiatan Lelang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Laporan Kegiatan Lelang</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Laporan Kegiatan Lelang</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="laporan_kegiatan_lelang.php" class="form-inline mb-3">
                                    <div class="form-group">
                                        <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                                    </div>
                                    <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                                    <div class="form-group">
                                        <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary larger p-2 ml-1">Cari</button>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>GOLONGAN</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>HARGA LELANG</th>
                                                <th>NILAI</th>
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
                                    <tr>
                                    <td style='text-align:center;'>" . $no . "</td>
                                    <td>$data[KODE]</td>
                                    <td>$data[NAMA]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[golongan]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td>" . rupiah($data['harga_beli']) . "</td>
                                    <td>" . rupiah($data['harga_lelang']) . "</td>
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
        </section>
    </div>
    <?php
    include("../unit/template/bawah.php");
    ?>
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
    </script>
    </body>

    </html>
<?php
}
?>