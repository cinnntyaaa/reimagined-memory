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
                <h1>Data Non Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Non Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Non Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_non_aset.php" method="POST">
                                            <select class="form-control" name="unit" id="unit" style="width: fit-content;">
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
                                            <button class="btn btn-primary larger p-2 ml-1" type='submit' name='submit'>Submit</button>
                                        </form>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TANGGAL</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JUMLAH</th>
                                                <th>HARGA</th>
                                                <th>UNIT</th>
                                                <th>RUANG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                include "koneksi.php";
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportNonAssetBase_unit(" . $unit . ")";
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
                                                                <td>$data[TANGGAL]</td>
                                                                <td>$data[KODE]</td>
                                                                <td>$data[NAMA]</td>
                                                                <td>$data[JUMLAH]</td>
                                                                <td>$data[HARGA]</td>
                                                                <td>$data[UNIT]</td>
                                                                <td>$data[RUANG]</td>
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
        </section>
    </div>
<?php
    include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "7") {
    include("../unit/template/atas.php");
?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header mb-3">
                <h1>Data Non Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Non Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Non Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_non_aset.php" method="POST">
                                            <select class="form-control" name="unit" id="unit" style="width: fit-content;">
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
                                            <button class="btn btn-primary larger p-2 ml-1" type='submit' name='submit'>Submit</button>
                                        </form>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TANGGAL</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JUMLAH</th>
                                                <th>HARGA</th>
                                                <th>UNIT</th>
                                                <th>RUANG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                include "koneksi.php";
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportNonAssetBase_unit(" . $unit . ")";
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
                                                                <td>$data[TANGGAL]</td>
                                                                <td>$data[KODE]</td>
                                                                <td>$data[NAMA]</td>
                                                                <td>$data[JUMLAH]</td>
                                                                <td>$data[HARGA]</td>
                                                                <td>$data[UNIT]</td>
                                                                <td>$data[RUANG]</td>
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
        </section>
    </div>
<?php
    include("../unit/template/bawah.php");
} else if ($_SESSION['privilege_id'] == "4") {
    include("../unit/template/atas.php");
?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header mb-3">
                <h1>Data Non Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Non Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Non Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_non_aset.php" method="POST">
                                            <select class="form-control" name="unit" id="unit" style="width: fit-content;">
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
                                            <button class="btn btn-primary larger p-2 ml-1" type='submit' name='submit'>Submit</button>
                                        </form>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>TANGGAL</th>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>JUMLAH</th>
                                                <th>HARGA</th>
                                                <th>UNIT</th>
                                                <th>RUANG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                include "koneksi.php";
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportNonAssetBase_unit(" . $unit . ")";
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
                                                                <td>$data[TANGGAL]</td>
                                                                <td>$data[KODE]</td>
                                                                <td>$data[NAMA]</td>
                                                                <td>$data[JUMLAH]</td>
                                                                <td>$data[HARGA]</td>
                                                                <td>$data[UNIT]</td>
                                                                <td>$data[RUANG]</td>
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
        </section>
    </div>
<?php
    include("../unit/template/bawah.php");
}
?>