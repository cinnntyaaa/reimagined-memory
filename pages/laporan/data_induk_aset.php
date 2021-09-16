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
                <h1>Data Induk Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Induk Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Induk Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_induk_aset.php" method="POST">
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
                                            <select class="form-control" name="gol" id="gol" style="width: fit-content;">
                                                <?php
                                                $sql = "SELECT ID, NAMA FROM golongan WHERE AKTIF = 1;";
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
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>PENYUSUTAN</th>
                                                <th>AKUMULASI</th>
                                                <th>NILAI</th>
                                                <th>KONDISI</th>
                                                <th>LOKASI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $gol  = $_POST['gol'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportAssetBase_nilai(" . $unit . ", " . $gol . ")";
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
                                    <td>$data[NAMA]</td>
                                    <td style='display:none'>$data[jenis]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td class='text-right'>" . rupiah($data['harga_beli']) . "</td>
                                    <td class='text-right'>" . rupiah($data['susut']) . "</td>
                                    <td class='text-right'>" . rupiah($data['akumulasi']) . "</td>
                                    <td class='text-right'>" . rupiah($data['nilai']) . "</td>
                                    <td>$data[kondisi]</td>
                                    <td>$data[lokasi]</td>
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
                <h1>Data Induk Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Induk Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Induk Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_induk_aset.php" method="POST">
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
                                            <select class="form-control" name="gol" id="gol" style="width: fit-content;">
                                                <?php
                                                $sql = "SELECT ID, NAMA FROM golongan WHERE AKTIF = 1;";
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
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>PENYUSUTAN</th>
                                                <th>AKUMULASI</th>
                                                <th>NILAI</th>
                                                <th>KONDISI</th>
                                                <th>LOKASI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $gol  = $_POST['gol'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportAssetBase_nilai(" . $unit . ", " . $gol . ")";
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
                                    <td>$data[NAMA]</td>
                                    <td style='display:none'>$data[jenis]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td class='text-right'>" . rupiah($data['harga_beli']) . "</td>
                                    <td class='text-right'>" . rupiah($data['susut']) . "</td>
                                    <td class='text-right'>" . rupiah($data['akumulasi']) . "</td>
                                    <td class='text-right'>" . rupiah($data['nilai']) . "</td>
                                    <td>$data[kondisi]</td>
                                    <td>$data[lokasi]</td>
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
                <h1>Data Induk Aset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
                    <div class="breadcrumb-item active" style="font-size: larger;">Data Induk Aset</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Data Induk Aset</h2>
                <p class="section-lead m-4">
                    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-inline mb-3">
                                        <form action="data_induk_aset.php" method="POST">
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
                                            <select class="form-control" name="gol" id="gol" style="width: fit-content;">
                                                <?php
                                                $sql = "SELECT ID, NAMA FROM golongan WHERE AKTIF = 1;";
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
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>KATEGORI</th>
                                                <th>TANGGAL BELI</th>
                                                <th>HARGA BELI</th>
                                                <th>PENYUSUTAN</th>
                                                <th>AKUMULASI</th>
                                                <th>NILAI</th>
                                                <th>KONDISI</th>
                                                <th>LOKASI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $no = 1;
                                                $unit = $_POST['unit'];
                                                $gol  = $_POST['gol'];
                                                $submit = $_POST['submit'];
                                                $sql = "CALL reportAssetBase_nilai(" . $unit . ", " . $gol . ")";
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
                                    <td>$data[NAMA]</td>
                                    <td style='display:none'>$data[jenis]</td>
                                    <td>$data[kategori]</td>
                                    <td>$data[tgl_beli]</td>
                                    <td class='text-right'>" . rupiah($data['harga_beli']) . "</td>
                                    <td class='text-right'>" . rupiah($data['susut']) . "</td>
                                    <td class='text-right'>" . rupiah($data['akumulasi']) . "</td>
                                    <td class='text-right'>" . rupiah($data['nilai']) . "</td>
                                    <td>$data[kondisi]</td>
                                    <td>$data[lokasi]</td>
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