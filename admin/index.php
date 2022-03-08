<?php
require('lock.php');
require('../dbconnect.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Vaccine Request System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
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

    <h1>Blood Request System Admin <small>Blood Data</small></h1><br>
    <h4><a href="index.php" >Blood Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="rv.php" >Reciever Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="req.php" >Request</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="wh.php" >Warehouse</a>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="vcadd.php" class="btn btn-primary pull-right">Add Blood</a><br><br>

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
                    <img src="../images/Vaccine.jpg"  style="width: 30px; height: 30px; object-fit: cover;">
                    <?php echo $row['bin'] ?>
                </td>
                <td><?php echo $row['hid'] ?></td>
                <td><?php echo $row['br'] ?></td>
                <td class="text-center">
                    <a href="vcedit.php?bin=<?php echo $row['bin'] ?>" class="btn btn-sm btn btn-warning">
                        <span class="glyphicon glyphicon-edit "></span>
                    </a>
                    <a href="vcdelete.php?bin=<?php echo $row['bin'] ?>" class="btn btn-sm btn btn-danger">
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