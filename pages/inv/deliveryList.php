<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Pengiriman Aset ke Unit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Pengiriman</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Pengiriman Aset</div>
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
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL deliveryList()";
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
                                                  <td class='align-middle'>$data[kode]</td>
                                                  <td class='align-middle'>$data[nama]</td>
                                                  <td class='text-center align-middle'><button class='btn bg-transparent' onclick=send($data[memoid],$data[dispoid])><img width='30px' src='../../assets/svg/kirim.svg'></button></td>
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
                <a class="modal-title h4"><u>Proses Pengiriman Aset</u></a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body align-self-center p-3">
                <div class="h5">
                Apakah Aset Ini Telah Dikirim Ke Ruang?
                </div>
                <div class="text-center">
                    <button class='btn btn-primary larger' type='submit' id='submit'>Sudah</button>
                    <button class='btn btn-primary larger' type="button" class="close" data-dismiss="modal">Belum</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../unit/template/bawah.php");
?>

<!-- Page Specific JS File -->
<script>
    function send(memoid, dispoid) {
        $("#myModal").modal("show");
        document.getElementById("submit").onclick = (function() {
            $.ajax({
                url: 'createDelivery.php',
                type: 'POST',
                data: {
                    memoid: memoid,
                    dispoid: dispoid
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