<?php include("../unit/template/atas.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header mb-3">
            <h1>Memo Pengadaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item" style="font-size: larger;"><a href="#">Memo</a></div>
                <div class="breadcrumb-item active" style="font-size: larger;">Memo Pengadaan</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md h6" id="myTable" data-toggle="table" data-detail-view="true" data-detail-formatter="detailFormatter">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>TANGGAL</th>
                                            <th>JUDUL</th>
                                            <th>PEMOHON</th>
                                            <th>PROSES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql = "CALL memoList_direksi(" . $user_id . ")";
                                        $outp = array();
                                        $dirUpload = "file/";
                                        if (mysqli_multi_query($conn, $sql)) {
                                            do {
                                                // Store first result set
                                                if ($result = mysqli_store_result($conn)) {
                                                    $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                                    // Fetch one and one row
                                                }
                                            } while (mysqli_next_result($conn));
                                            foreach ($outp[0] as $data) {
                                                $harga_rekom = ($data['harga_rekom'] == "-" ? '-' : rupiah($data['harga_rekom']));
                                                if ($data['attach_rekom'] == "") {
                                                    $attach = "-";
                                                } else {
                                                    $attach = "<a href='" . $dirUpload . $data['attach_rekom'] . "'>'File Lampiran'</a>";
                                                }
                                                echo "
                                                <tr>
                                                    <td class='align-middle text-center'>" . $no . "</td>
                                                    <td class='align-middle'>$data[tgl_memo]</td>
                                                    <td class='align-middle'>$data[JUDUL]</td>
                                                    <td class='align-middle'>$data[pemohon]</td>
                                                    <td class='align-middle text-center'><button class='btn bg-transparent' onclick=view($data[idmemo])><img width='30px' src='../../assets/svg/view.svg'></button></td>
                                                </tr>
                                                <span style='display: none;' id='desc" . $no . "'>
                                                    <strong>Description:</strong>
                                                    <br>
                                                    <pre>This is row with id=" . $no . ", containing other content</pre>
                                                </span>
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
        <div class="modal-content" style="color:black">
            <div class="modal-header p-3">
                <a class="modal-title underlineHover h5">Form Disposisi Memo Pengadaan</a>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-1" id="memoView">

            </div>
        </div>
    </div>
</div>
<?php
include("../unit/template/bawah.php");
?>

<!-- Page Specific JS File -->
<script>
    function view(idmemo) {
        var user_id = "<?php echo $user_id ?>";
        $.ajax({
            url: 'proses_memoView.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                user_id: user_id
            },
            dataType: 'html',
            success: function(data) {
                $("#myModal").modal("show");
                $("#memoView").html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    }
    $(document).ready(function() {
        var $table = $('#myTable');

        $table.on('expand-row.bs.table', function(e, index, row, $detail) {
            var res = $("#desc" + (index+1)).html();
            $detail.html(res);
        });

        $table.on("click-row.bs.table", function(e, row, $tr) {

            // prints Clicked on: table table-hover, no matter if you click on row or detail-icon
            console.log("Clicked on: " + $(e.target).attr('class'));

            // In my real scenarion, trigger expands row with text detailFormatter..
            //$tr.find(">td>.detail-icon").trigger("click");
            $tr.find(">td>.detail-icon").triggerHandler("click");
        });
    });
</script>
</body>

</html>