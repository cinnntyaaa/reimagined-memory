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
      <h2 class="section-title">Penerimaan Aset Unit</h2>
      <p class="section-lead m-4">
        <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
      </p>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <!-- Gradient divider -->
                <hr data-content="REQUEST MUTASI ASET BELUM DIKONFIRMASI" class="hr-text">
                <table class="table table-bordered table-md align-middle">
                  <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>UNIT PINJAM</th>
                    <th>TANGGAL PINJAM</th>
                    <th>PROSES</th>
                  </tr>
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
                                        <td style='text-align:center;'>" . $no . "</td>
                                        <td>$data[KODE]</td>
                                        <td>$data[NAMA]</td>
                                        <td>$data[unitpinjam]</td>
                                        <td>$data[TANGGAL_PINJAM]</td>
                                        <td class='text-center'><button class='btn bg-transparent' onclick=response($data[idmutasi])><img width='30px' height='30px' src='../../assets/svg/view.svg'></button></td>
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
                <table class="table table-bordered table-md align-middle">
                  <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>UNIT PINJAM</th>
                    <th>TANGGAL REJECT</th>
                  </tr>
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
                                        <td style='text-align:center;'>" . $no . "</td>
                                        <td>$data[KODE]</td>
                                        <td>$data[NAMA]</td>
                                        <td>$data[unitpinjam]</td>
                                        <td>$data[TGL_REJECT]</td>
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
                <table class="table table-bordered table-md align-middle">
                  <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>UNIT PINJAM</th>
                    <th>TANGGAL ACC</th>
                    <th>PROSES</th>
                  </tr>
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
                                        <td style='text-align:center;'>" . $no . "</td>
                                        <td>$data[KODE]</td>
                                        <td>$data[NAMA]</td>
                                        <td>$data[unitpinjam]</td>
                                        <td>$data[TANGGAL_ACC]</td>
                                        <td class='text-center'><button class='btn bg-transparent' onclick=response2($data[idmutasi])><img width='45px' height='45px' src='../../assets/svg/view.svg'></button></td>
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
                <table class="table table-bordered table-md align-middle">
                  <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>UNIT PINJAM</th>
                    <th>TANGGAL KEMBALI</th>
                  </tr>
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
                                        <td style='text-align:center;'>" . $no . "</td>
                                        <td>$data[KODE]</td>
                                        <td>$data[NAMA]</td>
                                        <td>$data[unitpinjam]</td>
                                        <td>$data[TANGGAL_KEMBALI]</td>
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
        <h4 class="modal-title">Respon Peminjaman</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="radio" id="acc" name="acc" value="3">
        <label for="acc">
          <h5>ACC</h5>
        </label><br>
        <input type="radio" id="reject" name="acc" value="2">
        <label for="reject">
          <h5>REJECT</h5>
        </label><br>
        <div class="text-center">
          <button class='btn btn-sm bg-tomato text-white' type='submit' id='submit'>Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Respon Peminjaman</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="radio" id="back" name="back" value="4">
        <label for="back">
          <h5>TELAH KEMBALI</h5>
        </label><br>
        <div class="text-center">
          <button class='btn btn-sm bg-tomato text-white' type='submit' id='submit2'>Submit</button>
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
          location.reload();
          // console.log(data);
        }
      });
    });
  }

  function response2(idmutasi) {
    $("#myModal2").modal("show");
    document.getElementById("submit2").onclick = (function() {
      var back = $("[name='back']:checked").val();
      var userid = "<?php echo $user_id ?>";
      $.ajax({
        url: 'createResponseMutasiKembali_unit.php',
        type: 'POST',
        data: {
          idmutasi: idmutasi,
          back: back,
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