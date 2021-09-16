<?php
include "../../koneksi.php";
if (isset($_POST['unitChoice'])) {
    $unitChoice = $_POST['unitChoice'];

    $sql = "SELECT ID, NAMA FROM ruang WHERE aktif = 1 AND unit_id = $unitChoice;";
    $query = mysqli_query($conn, $sql);
?>
    <?php if (mysqli_num_rows($query) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($query)) { ?>
            <option value="<?php echo $row['ID']; ?>">
                <?php echo $row['NAMA'] ?></option>
        <?php } ?>
<?php }

    mysqli_close($conn);
}
?>