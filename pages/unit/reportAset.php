<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Laporan Aset Unit <?php echo $namaUnit ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Laporan Aset Unit</div>
      </div>
    </div>
    <div class="section-body">
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
                      <th>RUANG</th>
                      <th>KONDISI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL assetList_unit(" . $unit_id . ");";
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
                            <td class='text-center align-middle'>" . $no . "</td>
                            <td class='align-middle'>$data[KODE]</td>
                            <td class='align-middle'>$data[nama]</td>
                            <td class='d-none'>$data[jenis]</td>
                            <td class='align-middle'>$data[kategori]</td>
                            <td class='align-middle'>$data[golongan]</td>
                            <td class='align-middle'>$data[ruang]</td>
                            <td class='align-middle'>$data[kondisi]</td>
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
include("template/bawah.php");
?>

</body>

</html>