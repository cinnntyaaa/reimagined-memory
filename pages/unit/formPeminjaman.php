<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Form Peminjaman Aset</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Peminjaman</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Form Peminjaman</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="form-inline mb-3">
                <form action="formPeminjaman.php" method="POST">
                  <select class="form-control" name="unit" id="unit">
                    <?php
                    $sql = "SELECT ID, NAMA FROM unit WHERE AKTIF = 1 AND MANAJERIAL = 0 AND ID != $unit_id;";
                    $query = mysqli_query($conn, $sql);
                    ?>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                      <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <option value=" <?php echo $row['ID']; ?>">
                          <?php echo $row['NAMA'] ?></option>
                      <?php } ?>
                    <?php }
                    ?>
                  </select>
                  <button class="btn btn-primary p-2 larger" type='submit' name='submit'>Pilih</button>
                </form>
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
                  <tbody class="align-middle">
                    <?php
                    if (isset($_POST['submit'])) {
                      $no = 1;
                      $unit = $_POST['unit'];
                      $submit = $_POST['submit'];
                      $sql = "CALL assetListView_unit(" . $unit . ");";
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
                                <td class='text-capitalize align-middle'>$data[nama]</td>
                                <td class='align-middle'>$data[kategori]</td>
                                <td class='align-middle'>$data[golongan]</td>
                                <td class='align-middle'>$data[ruang]</td>
                                <td class='align-middle'>$data[kondisi]</td>
                                <td class='text-center align-middle'><button class='btn bg-transparent' onclick=mutasi($data[ASET_ID],$data[UNIT_ID],$data[RUANG_ID])><img width='30px' height='30px' src='../../assets/svg/view.svg'></button></td>
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
    <div class="modal-content black">
      <div class="modal-header border-bottom p-3">
        <a class="modal-title h4"><u>Form Mutasi Aset Sementara</u></a>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p-3">
        <div class="h5 form-inline justify-content-center">
          <label>Pilih Ruang :</label>&nbsp;
          <select name="ruangMutasi" id="ruangMutasi" style="width: fit-content;">
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
        <div class="text-center mt-3">
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
      document.getElementById('submitMutasi').setAttribute("disabled", "disabled");
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
          alert("Peminjaman Aset Berhasil!");
        }
      });
    });
  }
</script>
</body>

</html>