<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Memo Pengadaan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active" style="font-size: larger;"><a href="#">Memo</a></div>
        <div class="breadcrumb-item" style="font-size: larger;">Memo Baru</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form action="newMemo.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nomor">Nomor Memo</label>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="nomor" name="nomor" autocomplete="off" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="ju6ul">Judul</label>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="judul" name="judul" autocomplete="off" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="ket">Keterangan / Spesifikasi</label>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="ket" name="ket" autocomplete="off" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="biaya">Biaya</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Rp.</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="biaya" name="biaya" autocomplete="off" required>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="qty">Jumlah</label>
                    <input type="text" onkeypress='validate(event)' class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="qty" name="qty" autocomplete="off" required>
                  </div>
                  <div class="form-group col-sm-4">
                    <label for="unit">Ruang</label>
                    <select id="unit" name="unit" class="form-control">
                      <?php
                      $sql = "SELECT id, nama FROM ruang WHERE id > 1 AND aktif = 1 AND unit_id = $unit_id;";
                      $query = mysqli_query($conn, $sql);
                      ?>
                      <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                          <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['nama'] ?></option>
                        <?php } ?>
                      <?php }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-4">
                    <label>File Lampiran</label>
                    <div class="custom-file">
                      <input type="file" name="berkas" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-row form-group">
                  <label for="latar">Latar Belakang</label>
                  <textarea class="form-control" id="latar" rows="4" name="latar" style="height: 100px;"></textarea>
                </div>
                <div class="card-footer text-center">
                  <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary larger fw-normal">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
$nomor = $_POST['nomor'];
$judul = $_POST['judul'];
$ket = $_POST['ket'];
$latar = $_POST['latar'];
$folder = "../../file/";
$nama_file = $_FILES['berkas']['name'];
$file = $folder . $nama_file;
$biaya = str_replace('.', '', $_POST['biaya']);
$qty = $_POST['qty'];
$unit = $_POST['unit'];

// ambil data file
$namaFile = $_FILES['berkas']['name'];
$namaSementara = $_FILES['berkas']['tmp_name'];

// tentukan lokasi file akan dipindahkan
$dirUpload = "../../file/";

$temp = explode(".", $_FILES["berkas"]["name"]);
$newfilename = $user_id;
$newfilename .= round(microtime(true)) . '.' . end($temp);
// pindahkan file
$terupload = move_uploaded_file($namaSementara, $dirUpload . $newfilename);

// jika tidak ada lampiran file
if (!$terupload) {
  $nama_file = "";
} else {
  $nama_file = $newfilename;
}
$submit = $_POST['submit'];

if ($submit) {
  // if ($terupload) {
  $sql = "CALL createMemo ('" . $nomor . "','" . $judul . "','" . $ket . "','" . $latar . "','" . $nama_file . "'," . $biaya . "," . $qty . "," . $user_id . "," . $privilege_id . "," . $unit . ")";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    echo '<script>alert("Berhasil menambahkan data.");</script>';
  } else {
    echo '<script>alert("Gagal melakukan proses tambah data.");</script>';
  }
  // } else {
  //     echo "Upload Gagal!";
  // }
}
?>

<?php
include("template/bawah.php");
?>

<!-- Page Specific JS File -->
<script>
  var rupiah = document.getElementById("biaya");
  rupiah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value);
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? rupiah : "";
  }

  function validate(evt) {
    if (evt.keyCode != 9 && evt.keyCode != 8 && evt.keyCode != 46) {
      var theEvent = evt || window.event;

      // Handle paste
      if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
      } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
    }

  }
</script>
</body>

</html>