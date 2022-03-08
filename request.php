<?php
require('session.php');
require('dbconnect.php');
require('header.php');

$warehouseid = isset($_GET['warehouseid']) ? $_GET['warehouseid'] : "";
$rid = isset($_GET['rid']) ? $_GET['rid'] : "";
if ($warehouseid != "" && $rid != "") {
    $sql = "SELECT * FROM vaccinereqest LEFT JOIN warehouse ON vaccinereqest.warehouseid=warehouse.warehouseid LEFT JOIN receivers ON vaccinereqest.rid=receivers.rid LEFT JOIN vaccineinfo ON vaccinereqest.hid=vaccineinfo.hid WHERE vaccinereqest.rid='$rid' and vaccinereqest.warehouseid='$warehouseid'";
}
else if ($warehouseid != "") {
    $sql = "SELECT * FROM vaccinereqest LEFT JOIN warehouse ON vaccinereqest.warehouseid=warehouse.warehouseid LEFT JOIN receivers ON vaccinereqest.rid=receivers.rid LEFT JOIN vaccineinfo ON vaccinereqest.hid=vaccineinfo.hid WHERE vaccinereqest.warehouseid='$warehouseid'";
}
else if ($rid != "") {
    $sql = "SELECT * FROM vaccinereqest LEFT JOIN warehouse ON vaccinereqest.warehouseid=warehouse.warehouseid LEFT JOIN receivers ON vaccinereqest.rid=receivers.rid LEFT JOIN vaccineinfo ON vaccinereqest.hid=vaccineinfo.hid WHERE vaccinereqest.rid='$rid'";
}
else {
    $sql = "SELECT * FROM vaccinereqest LEFT JOIN warehouse ON vaccinereqest.warehouseid=warehouse.warehouseid LEFT JOIN receivers ON vaccinereqest.rid=receivers.rid LEFT JOIN vaccineinfo ON vaccinereqest.hid=vaccineinfo.hid";
}
$results = $conn->query($sql);
?>

    <form method="get" class="form-inline">
    hospitalID: &nbsp;
        <input type="text" name="warehouseid" class="form-control" placeholder="email">
        รหัสเลือด: &nbsp;
        <input type="text" name="rid" class="form-control" placeholder="รหัสเลือด">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Req ID</th>
                <th>hospital ID</th>
                <th>Email</th>
                <th>รหัสเลือด</th>
                <th>กรุ๊ป</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['reqid'] ?></td>
                <td><?php echo $row['warehouseid'] ?></td>
                <td><?php echo $row['remail'] ?></td>
                <td><?php echo $row['hid'] ?></td>
                <td><?php echo $row['br'] ?></td>
                <td><?php echo $row['status_2'] ?></td>
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
