<?php
require('session.php');
require('dbconnect.php');
require('header.php');

$bin = isset($_GET['bin']) ? $_GET['bin'] : "";
$hid = isset($_GET['hid']) ? $_GET['hid'] : "";
if ($bin != "" && $hid != "") {
    $sql = "select * from vaccineinfo where bin='$bin' and hid='$hid'";
}
else if ($bin != "") {
    $sql = "select * from vaccineinfo where bin='$bin'";
}
else if ($hid != "") {
    $sql = "select * from vaccineinfo where hid='$hid'";
}
else {
    $sql = "select * from vaccineinfo";
}
$results = $conn->query($sql);
?>

    <form method="get" class="form-inline">
        ลำดับ: &nbsp;
        <input type="text" name="bin" class="form-control" placeholder="ลำดับ">
        รหัสเลือด: &nbsp;
        <input type="text" name="hid" class="form-control" placeholder="รหัสเลือด">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>รหัสเลือด</th>
                <th>กรุ๊ป</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td>
                    <img src="../images/Vaccine.png"  style="width: 30px; height: 30px; object-fit: cover;">
                    <?php echo $row['bin'] ?>
                </td>
                <td><?php echo $row['hid'] ?></td>
                <td><?php echo $row['br'] ?></td>
                <td class="text-center">
                    <a href="sendreq.php?hid=<?php echo $row['hid'] ?>" class="btn btn-sm btn btn-warning">
                        request</span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php
require('footer.php');
?>
