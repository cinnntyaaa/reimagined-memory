<?php include("template/atas.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header mb-3">
      <h1>Laporan Memo Pengadaan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Laporan</a></div>
        <div class="breadcrumb-item active" style="font-size: larger;">Laporan Memo</div>
    </div>
</div>
<div class="section-body">
  <h2 class="section-title">Laporan Memo Unit <?php echo $namaUnit ?></h2>
  <p class="section-lead m-4">
    <!-- Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms. -->
</p>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
            <form method="post" action="reportMemo.php" class="form-inline mb-3">
                <div class="form-group">
                    <input id="tgl_awal" name="tgl_awal" type="text" class="form-control text-center" placeholder="Tanggal Awal" autocomplete="off" required />
                </div>
                <h5 class="m-0 ml-2 mr-2 font-weight-bold">s/d</h5>
                <div class="form-group">
                    <input id="tgl_akhir" name="tgl_akhir" type="text" class="form-control text-center" placeholder="Tanggal Akhir" autocomplete="off" required />
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-primary p-2 ml-2 larger">Cari</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-md h6">
                  <thead>
                    <tr>
                      <th class="align-middle">NO</th>
                      <th class="align-middle">KODE</th>
                      <th class="align-middle">JUDUL</th>
                      <!-- <th class="align-middle">KETERANGAN</th>
                      <th class="align-middle">BIAYA</th>
                      <th class="align-middle">JUMLAH</th> -->
                      <th class="align-middle">STATUS</th>
                      <!-- <th class="align-middle">DISPOSISI</th>
                      <th class="align-middle">BIAYA DISPOSISI</th>
                      <th class="align-middle">JUMLAH DISPOSISI</th> -->
                      <th class="align-middle">HAPUS</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $temp_tgla;
                $temp_tglb;
                if (isset($_POST['submit'])) {
                    $no = 1;
                    $tgl_awal = $_POST['tgl_awal'];
                    $tgl_akhir = $_POST['tgl_akhir'];
                    $temp_tgla = (empty($_POST)) ? date('Y-m-d') : $_POST['tgl_awal'];
                    $temp_tglb = (empty($_POST)) ? date('Y-m-d') : $_POST['tgl_akhir'];
                    $submit = $_POST['submit'];
                    $sql = "CALL reportMemo_unit (" . $user_id . ", '" . $tgl_awal . "', '" . $tgl_akhir . "')";
                    $query = mysqli_query($conn, $sql);
                    $status = mysqli_affected_rows($conn);
                    if ($status > 0) {
                        echo "<script>document.getElementById('tgl_awal').value = '" . "$temp_tgla" . "';
                        document.getElementById('tgl_akhir').value = '" . "$temp_tglb" . "';</script>";
                    }
                    while ($data = mysqli_fetch_array($query)) {
                        if ($data['STATUS'] == 0) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/filter.svg' title='FILTER'>"; #FILTER
                            } else if ($data['STATUS'] == 1) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/sent.svg' title='SENT'>"; #SENT
                            } else if ($data['STATUS'] == 2) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/rekom.svg' title='REKOM'>"; #REKOM
                            } else if ($data['STATUS'] == 3) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/process.svg' title='PROCESS'>"; #PROCESS
                            } else if ($data['STATUS'] == 4) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/rejected.svg' title='REJECTED'>"; #REJECTED
                            } else if ($data['STATUS'] == 5) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/approved.svg' title='APPROVED'>"; #APPROVED
                            } else if ($data['STATUS'] == 6) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/buy_less.svg' title='BUY LESS'>"; #BUY LESS
                            } else if ($data['STATUS'] == 7) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/buy_complete.svg' title='BUY COMPLETE'>"; #BUY COMPLETE
                            } else if ($data['STATUS'] == 8) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/eval_less.svg' title='EVAL LESS'>"; #EVAL LESS
                            } else if ($data['STATUS'] == 9) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/eval_complete.svg' title='EVAL COMPLETE'>"; #EVAL COMPLETE
                            } else if ($data['STATUS'] == 10) {
                                $status = "<img width='30px' height='30px' src='../../assets/svg/done.svg' title='DELIVERED'>"; #DELIVERED
                            }
                            $biaya_dispo = ($data['biaya_dispo'] == "-" ? '-' : rupiah($data['biaya_dispo']));
                            echo "
                            <tr class='parent' id=".$no." style='cursor: pointer;'>
                                <td class='text-center align-middle' style='width:fit-content'>" . $no . "</td>
                                <td class='d-none'>$data[idmemo]</td>
                                <td class='align-middle'>$data[KODE]</td>
                                <td class='align-middle'>$data[JUDUL]</td>
                                <td class='align-middle d-none'>$data[KETERANGAN]</td>
                                <td class='text-right align-middle d-none'>" . rupiah($data['harga_memo']) . "</td>
                                <td class='text-right align-middle d-none'>$data[qty_memo]</td>
                                <td class='align-middle text-center'>$status</td>
                                <td class='align-middle d-none'>$data[disposisi]</td>
                                <td class='text-right align-middle d-none'>$biaya_dispo</td>
                                <td class='text-right align-middle d-none'>$data[qty_dispo]</td>
                                <td class='text-center'><button class='btn bg-transparent' onclick=hapus($data[idmemo])><i class='fa fa-trash-alt'></i></button></td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Keterangan :</td>
                                <td colspan=3>$data[KETERANGAN]</td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Harga :</td>
                                <td colspan=3>" . rupiah($data['harga_memo']) . "</td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Jumlah :</td>
                                <td colspan=3>$data[qty_memo]</td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Disposisi :</td>
                                <td colspan=3>$data[disposisi]</td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Biaya Disposisi :</td>
                                <td colspan=3>$biaya_dispo</td>
                            </tr>
                            <tr class='child-".$no."' style='display: none;'>
                                <td></td>
                                <td>Jumlah Disposisi :</td>
                                <td colspan=3>$data[qty_dispo]</td>
                            </tr>
                            
                            ";
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
                <a class="modal-title h5">Hapus Memo</a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h5>Apakah Memo Ini Akan Dihapus?</h5>
                <button type='submit' id='kirim' class="btn bg-primary">YA</button>
            </div>
        </div>
    </div>
</div>
<?php
include("template/bawah.php");
?>

<!-- Page Specific JS File -->
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

//   function showHideRow(row) {
//     $("#" + row).toggle();
// }
$(document).ready(function () {  
    $('tr.parent')  
    .css("cursor", "pointer")  
    .attr("title", "Click to expand/collapse")  
    .click(function () {  
        $(this).siblings('.child-' + this.id).toggle();  
    });  
    $('tr[@class^=child-]').hide().children('td');  
});  

function hapus(idmemo) {
    $("#myModal").modal("show");
    document.getElementById("kirim").onclick = (function() {
        var tgl_awal = $("#tgl_awal").val();
        var tgl_akhir = $("#tgl_akhir").val();
        var user_id = "<?php echo $user_id; ?>";
        $.ajax({
            url: 'deleteMemo_unit.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                user_id: user_id,
                tgl_awal: tgl_awal,
                tgl_akhir: tgl_akhir
            },
            dataType: 'html',
            success: function(data) {
                    // if (data == 1) {
                    //     // location.reload();
                    //     window.location = window.location;
                    // } else if (data == 0) {
                    //     alert("hapus gagal");
                    //     $("#myModal").modal("hide");
                    // }
                    let arrayResult = data.split(";");
                    console.log(arrayResult[3]);
                    if (arrayResult[3] == 0) {
                        alert("hapus gagal");
                        $("#myModal").modal("hide");
                    } else {
                        document.getElementById("tgl_awal").value = arrayResult[1];
                        document.getElementById("tgl_akhir").value = arrayResult[2];
                        document.getElementById("submit").click();
                    }
                }
            });
    });
}
</script>
</body>

</html>