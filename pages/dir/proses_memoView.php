<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, '.', ',');
    return $hasil_rupiah;
}
include "../../koneksi.php";
$idmemo = ($_POST['idmemo']);
$user_id = ($_POST['user_id']);
$sql = "CALL memoView_direksi(" . $idmemo . ");";
// Execute multi query
if (mysqli_multi_query($conn, $sql)) {
    do {
        // Store first result set
        if ($result = mysqli_store_result($conn)) {
            $outp[] = $result->fetch_all(MYSQLI_ASSOC);
            // Fetch one and one row
        }
    } while (mysqli_next_result($conn));
    // echo $idk;
    foreach ($outp[1] as $data) {
        echo "
            <table class='table table-sm h6'>
                <tr>
                    <td class='align-middle text-right'>Tanggal : </td>
                    <td class='align-middle' id='tgl_memo'>" . $data['tgl_memo'] . "</td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Kode : </td>
                    <td class='align-middle' id='kode'>" . $data['KODE'] . "</td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Judul : </td>
                    <td class='align-middle' id='judul'>" . $data['JUDUL'] . "</td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Keterangan : </td>
                    <td class='align-middle'><textarea rows='3' id='ket' style='width:325px'>" . $data['KET_REKOM'] . "</textarea></td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Harga : </td>
                    <td class='align-middle'>" . rupiah($data['harga_memo']) . "&nbsp;<input class='inputView' id='harga_memo' value=" . $data['harga_memo'] . " autocomplete='off'></td>
                </tr>
                <tr>
                    <td class='align-middle text-right''>Jumlah : </td>
                    <td class='align-middle'>" . $data['qty_memo'] . "<input class='inputView' style='margin-left:132px' id='qty_memo' value=" . $data['qty_memo'] . "></td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Pemohon : </td>
                    <td class='align-middle' id='pemohon'>" . $data['pemohon'] . "</td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Unit : </td>
                    <td class='align-middle' id='unit'>" . $data['unit'] . "</td>
                    <td id='id_memo' style='display:none'>" . $data['idmemo'] . "</td>
                    <td id='user_id' style='display:none'>" . $user_id . "</td>
                </tr>
                <tr>
                    <td class='align-middle text-right'>Ruang : </td>
                    <td class='align-middle' id='ruang'>" . $data['ruang'] . "</td>
                </tr>     
            ";
    }
    echo "
    <tr>
    <td class='align-middle text-right'>PIC : </td>
    <td class='align-middle'><select id='pic'>";
    foreach ($outp[0] as $data) {
        echo "<option value='$data[ids]'>$data[pic]</option>";
    }
    echo "   
        </select></td>
    </tr>
    <tr style='border-bottom: hidden;'>
        <td class='align-middle text-right'>Pilihan :</td>
        <td>
            <select id='acc'>
                <option value='5'>ACC</option>
                <option value='4'>REJECT</option>
                <option value='11'>PENDING</option>
            </select>
        </td>
    </tr>
    </table>
    <div class='text-center mb-2'>
        <button class='btn btn-primary larger' type='submit' id='submit'>Submit</button>
    </div>";
}
?>
<script>
    var rupiah = document.getElementById("harga_memo");
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

    document.getElementById("submit").onclick = (function() {
        var idmemo = $("#id_memo").text();
        var acc = $("#acc").val();
        var ket = $("#ket").val();
        var harga2 = $("#harga_memo").val();
        var harga = harga2.replace(/[^,\d]/g, "");
        var qty = $("#qty_memo").val();
        var ids = $("#pic").val();
        var userid = $("#user_id").text();
        $.ajax({
            url: 'memoResponse.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                acc: acc,
                ket: ket,
                harga: harga,
                qty: qty,
                ids: ids,
                userid: userid
            },
            dataType: 'html',
            success: function(data) {
                location.reload();
                // console.log(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    });
</script>