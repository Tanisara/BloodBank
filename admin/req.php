<?php
require('lock.php');
require('../dbconnect.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Request System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
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

    <h1>Blood Request System Admin <small>Request</small></h1><br>
    <h4><a href="index.php" >Blood Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="rv.php" >Reciever Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="req.php" >Request</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="wh.php" >Warehouse</a>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="reqadd.php" class="btn btn-primary pull-right">Add Request</a><br><br>

    <form method="get" class="form-inline">
    hospitalID: &nbsp;
        <input type="text" name="warehouseid" class="form-control" placeholder="email">
        ลำดับ: &nbsp;
        <input type="text" name="rid" class="form-control" placeholder="rid">
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
                <th></th>
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
                <td class="text-center">
                    <a href="reqedit.php?reqid=<?php echo $row['reqid'] ?>" class="btn btn-sm btn btn-warning">
                        <span class="glyphicon glyphicon-edit "></span>
                    </a>
                    <a href="reqdelete.php?reqid=<?php echo $row['reqid'] ?>" class="btn btn-sm btn btn-danger">
                        <span class="glyphicon glyphicon-trash "></span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php
$conn->close();
?>
</body>
</html>