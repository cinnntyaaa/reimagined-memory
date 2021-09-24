<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Form Penerimaan Aset</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Penerimaan</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Form Penerimaan</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <!-- Gradient divider -->
                <hr data-content="REQUEST MUTASI ASET BELUM DIKONFIRMASI" class="hr-text">
                <table class="table table-bordered table-md h6">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <th>UNIT PINJAM</th>
                      <th>TANGGAL PINJAM</th>
                      <th>PROSES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL requestMutasiList_unit(" . $unit_id . ");";
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
                              <td class='text-center align-middle'>" . $no . "</td>
                              <td class='align-middle'>$data[KODE]</td>
                              <td class='align-middle'>$data[NAMA]</td>
                              <td class='align-middle'>$data[unitpinjam]</td>
                              <td class='align-middle'>$data[TANGGAL_PINJAM]</td>
                              <td class='text-center'><button class='btn bg-transparent' onclick=response($data[idmutasi])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                          </tr> ";
                        $no++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive mt-3">
                <hr data-content="REQUEST MUTASI ASET DITOLAK" class="hr-text">
                <table class="table table-bordered table-md h6">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <th>UNIT PINJAM</th>
                      <th>TANGGAL REJECT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL requestMutasiList_unit(" . $unit_id . ");";
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
                              <td class='text-center align-middle'>" . $no . "</td>
                              <td class='align-middle'>$data[KODE]</td>
                              <td class='align-middle'>$data[NAMA]</td>
                              <td class='align-middle'>$data[unitpinjam]</td>
                              <td class='align-middle'>$data[TGL_REJECT]</td>
                          </tr> ";
                        $no++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive mt-3">
                <hr data-content="REQUEST MUTASI ASET TELAH DISETUJUI" class="hr-text">
                <table class="table table-bordered table-md h6">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <th>UNIT PINJAM</th>
                      <th>TANGGAL ACC</th>
                      <th>PROSES</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL requestMutasiList_unit(" . $unit_id . ");";
                    $outp = array();
                    if (mysqli_multi_query($conn, $sql)) {
                      do {
                        // Store first result set
                        if ($result = mysqli_store_result($conn)) {
                          $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                          // Fetch one and one row
                        }
                      } while (mysqli_next_result($conn));
                      foreach ($outp[2] as $data) {
                        echo "
                          <tr>
                              <td class='text-center align-middle'>" . $no . "</td>
                              <td class='align-middle'>$data[KODE]</td>
                              <td class='align-middle'>$data[NAMA]</td>
                              <td class='align-middle'>$data[unitpinjam]</td>
                              <td class='align-middle'>$data[TANGGAL_ACC]</td>
                              <td class='text-center'><button class='btn bg-transparent' onclick=response2($data[idmutasi])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                          </tr> ";
                        $no++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive mt-3">
                <hr data-content="REQUEST MUTASI ASET DIKEMBALIKAN" class="hr-text">
                <table class="table table-bordered table-md h6">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>NAMA</th>
                      <th>UNIT PINJAM</th>
                      <th>TANGGAL KEMBALI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $sql = "CALL requestMutasiList_unit(" . $unit_id . ");";
                    $outp = array();
                    if (mysqli_multi_query($conn, $sql)) {
                      do {
                        // Store first result set
                        if ($result = mysqli_store_result($conn)) {
                          $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                          // Fetch one and one row
                        }
                      } while (mysqli_next_result($conn));
                      foreach ($outp[3] as $data) {
                        echo "
                          <tr>
                              <td class='text-center align-middle'>" . $no . "</td>
                              <td class='align-middle'>$data[KODE]</td>
                              <td class='align-middle'>$data[NAMA]</td>
                              <td class='align-middle'>$data[unitpinjam]</td>
                              <td class='align-middle'>$data[TANGGAL_KEMBALI]</td>
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
    <div class="modal-content black">
      <div class="modal-header border-bottom p-3">
        <a class="modal-title h4"><u>Response Peminjaman</u></a>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p-3">
        <div class="h5">
          <fieldset class="border p-2">
            <legend class="w-auto">Pilih Response :</legend>
            <input type="radio" id="acc" name="acc" value="3">
            <label for="acc">
              <h5>ACC</h5>
            </label><br>
            <input type="radio" id="reject" name="acc" value="2">
            <label for="reject">
              <h5>REJECT</h5>
            </label>
          </fieldset>
        </div>
        <div class="text-center">
          <button class='btn btn-primary larger' type='submit' id='submit'>Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content black">
      <div class="modal-header border-bottom p-3">
        <a class="modal-title h4"><u>Form Pengembalian</u></a>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body align-self-center p-3">
        <div class="h5">
          Apakah Aset Telah Dikembalikan?
        </div>
        <div class="text-center">
          <button class='btn btn-primary larger' type='submit' id='submit2'>Sudah</button>
          <button class='btn btn-primary larger' type="button" class="close" data-dismiss="modal">Belum</button>
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
  function response(idmutasi) {
    $("#myModal").modal("show");
    document.getElementById("submit").onclick = (function() {
      document.getElementById('submit').setAttribute("disabled", "disabled");
      var acc = $("[name='acc']:checked").val();
      var userid = "<?php echo $user_id ?>";
      $.ajax({
        url: 'createResponseMutasi_unit.php',
        type: 'POST',
        data: {
          idmutasi: idmutasi,
          acc: acc,
          userid: userid
        },
        dataType: 'html',
        success: function(data) {
          if (!$('input[name=acc]:checked').val()) {
            alert("Pilih Terlebih Dahulu!");
            document.getElementById('submit').removeAttribute("disabled", "disabled");
          } else {
            location.reload();
          }
          // console.log(data);
        }
      });
    });
  }

  function response2(idmutasi) {
    $("#myModal2").modal("show");
    document.getElementById("submit2").onclick = (function() {
      document.getElementById('submit2').setAttribute("disabled", "disabled");
      var userid = "<?php echo $user_id ?>";
      $.ajax({
        url: 'createResponseMutasiKembali_unit.php',
        type: 'POST',
        data: {
          idmutasi: idmutasi,
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