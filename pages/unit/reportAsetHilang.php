<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Pelaporan Aset Hilang & Request Service</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Pelaporan Aset Hilang</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Aset Hilang / Service</h2>
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
                      <th>NO.</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <!-- <th>Kategori</th>
                    <th>Golongan</th> -->
                      <th>RUANG</th>
                      <th>KONDISI</th>
                      <th>PROSES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL pemeliharaanList(" . $unit_id . ");";
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
                              <td style='display:none'>$data[jenis]</td>
                              <td style='display:none'>$data[kategori]</td>
                              <td style='display:none'>$data[golongan]</td>
                              <td class='align-middle'>$data[ruang]</td>
                              <td class='align-middle'>$data[kondisi]</td>
                              <td class='text-center align-middle'><button class='btn bg-transparent' onclick=maintenance($data[ASET_ID],$data[DEPRESI_ID],$data[UNIT_ID],$user_id)><img width='30px' src='../../assets/svg/view.svg'></button></td>
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
      <div class="modal-header border-bottom p-3">
        <a class="modal-title h4"><u>Form Pemeliharaan</u></a>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p-3">
        <div class="h5">
          <label>Pilih Kondisi :</label>
          <select id="kondisi" name="kondisi">
            <?php
            $sql = "SELECT id, NAMA FROM kondisi WHERE ID IN (5,20) AND AKTIF = 1";
            $query = mysqli_query($conn, $sql);
            ?>
            <?php if (mysqli_num_rows($query) > 0) { ?>
              <?php while ($row = mysqli_fetch_array($query)) { ?>
                <option value="<?php echo $row['id']; ?>">
                  <?php echo $row['NAMA'] ?></option>
              <?php } ?>
            <?php }
            ?>
          </select><br><br>
          <label>Keterangan :</label>
          <textarea type="text" class="form-control" style="height: 150px;" name="ket" id="ket"></textarea>
        </div>
        <div class="text-center">
          <button type='submit' id='submitMaint' class="btn btn-primary larger">Submit</button>
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
  function maintenance(asetid, depreid, unitid, userid) {
    $("#myModal").modal("show");
    document.getElementById("submitMaint").onclick = (function() {
      var kondisi = $("#kondisi").val();
      var ket = $("#ket").val();
      $.ajax({
        url: 'createKondisi_request.php',
        type: 'POST',
        data: {
          asetid: asetid,
          depreid: depreid,
          unitid: unitid,
          kondisi: kondisi,
          ket: ket,
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