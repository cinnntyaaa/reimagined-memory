<?php
include "../../koneksi.php";
$idmemo = $_POST['idmemo'];
$id_dispo = $_POST['id_dispo'];
$user_id = $_POST['user_id'];
echo "
            <table class='table' id='disposisi_view'>
                <tr>
                    <td style='text-align: right; border-top: none'>No. Faktur : </td>
                    <td style='border-top: none'><input class='inputView' id='faktur' autocomplete='off'></td>
                </tr>
                <tr>
                    <td style='text-align: right;'>Nama : </td>
                    <td><input class='inputView' id='nama' autocomplete='off'></td>
                </tr>
                <tr>
                    <td style='text-align: right'>Tanggal : </td>
                    <td><input class='inputView' id='tanggal' type='text' autocomplete='off' required /></td>
                </tr>
                <tr>
                    <td style='text-align: right'>Harga Satuan : </td>
                    <td><input class='inputView' id='harga' autocomplete='off'></td>
                </tr>
                <tr>
                    <td style='text-align: right'>Jumlah : </td>
                    <td><input class='inputView' id='qty' autocomplete='off'></td>
                </tr>
                <tr>
                    <td style='text-align: right'>Keterangan : </td>
                    <td><textarea id='ket' style='width:300px' autocomplete='off'></textarea></td>
                </tr>
                <tr>
                    <td style='text-align: right'>Nomor Seri : </td>
                    <td><input class='inputView' id='no_seri' autocomplete='off'></td>
                    <td id='id_memo' style='display:none'>" . $idmemo . "</td>
                    <td id='id_dispo' style='display:none'>" . $id_dispo . "</td>
                    <td id='user_id' style='display:none'>" . $user_id . "</td>
                </tr>
            </table>
            <div class='text-center'>
            <button class='btn btn-primary larger' type='submit' id='submit'>Submit</button>
            </div>
            ";

?>
<script>
    $(function() {
        $("#tanggal").datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            endDate: new Date()
        });
    });
    document.getElementById("submit").onclick = (function() {
        var idmemo = $("#id_memo").text();
        var id_dispo = $("#id_dispo").text();
        var userid = $("#user_id").text();
        var faktur = $("#faktur").val();
        var nama = $("#nama").val();
        var tanggal = $("#tanggal").val();
        var harga2 = $("#harga").val();
        var harga = harga2.replace(/[^,\d]/g, "");
        var qty = $("#qty").val();
        var ket = $("#ket").val();
        var seri = $("#no_seri").val();
        $.ajax({
            url: 'createPurchase.php',
            type: 'POST',
            data: {
                idmemo: idmemo,
                id_dispo: id_dispo,
                userid: userid,
                faktur: faktur,
                nama: nama,
                tanggal: tanggal,
                harga: harga,
                qty: qty,
                ket: ket,
                seri: seri
            },
            dataType: 'html',
            success: function(data) {
                location.reload();
                // console.log(data)
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    });
    var rupiah = document.getElementById("harga");
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
</script>