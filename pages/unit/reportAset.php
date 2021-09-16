<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Laporan Aset</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Laporan Aset Unit</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Laporan Aset Unit <?php echo $namaUnit ?></h2>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <a class="modal-title h5"><u>Form Mutasi Aset Sementara</u></a>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-inline justify-content-center mb-3 larger">
          <label for="ruangMutasi">
            Ruang :
          </label>
          <select class="form-control ml-3" name="ruangMutasi" id="ruangMutasi" style="width: fit-content;">
            <?php
            $sql = "SELECT ID, NAMA FROM ruang WHERE unit_id = $unit_id;";
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
        </div>
        <div class="text-center">
          <button class='btn btn-primary larger' type='submit' id="submitMutasi">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("template/bawah.php");
?>

<!-- Page Specific JS File -->

<script>
  function mutasi(asetid, unitid, ruangid) {
    $("#myModal").modal("show");
    document.getElementById("submitMutasi").onclick = (function() {
      var unit = "<?php echo $unit_id ?>";
      var ruangMutasi = $("#ruangMutasi").val();
      var userid = "<?php echo $user_id ?>";
      $.ajax({
        url: 'createRequestMutasi_unit.php',
        type: 'POST',
        data: {
          asetid: asetid,
          unitid: unitid,
          ruangid: ruangid,
          unit: unit,
          ruangMutasi: ruangMutasi,
          userid: userid
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