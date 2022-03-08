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
$whname = isset($_GET['whname']) ? $_GET['whname'] : "";
$bin = isset($_GET['bin']) ? $_GET['bin'] : "";
if ($bin != "" && $whname != "") {
    $sql = "SELECT * FROM warehouse LEFT JOIN vaccineinfo ON warehouse.bin=vaccineinfo.bin WHERE warehouse.bin='$bin' and warehouse.whname='$whname'";
}
else if ($bin != "") {
    $sql = "SELECT * FROM warehouse LEFT JOIN vaccineinfo ON warehouse.bin=vaccineinfo.bin WHERE warehouse.bin='$bin'";
}
else if ($whname != "") {
    $sql = "SELECT * FROM warehouse LEFT JOIN vaccineinfo ON warehouse.bin=vaccineinfo.bin WHERE warehouse.whname='$whname'";
}
else {
    $sql = "SELECT * FROM warehouse LEFT JOIN vaccineinfo ON warehouse.bin=vaccineinfo.bin ";
}
$results = $conn->query($sql);
?>

    <h1>Blood Request System Admin <small>hospital</small></h1><br>
    <h4><a href="index.php" >Blood Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="rv.php" >Reciever Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="req.php" >Request</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="wh.php" >Warehouse</a>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="whadd.php" class="btn btn-primary pull-right">Add Request</a><br><br>

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
                <th>hospital ID</th>
                <th>ลำดับ</th>
                <th>Warehouse Name"</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone</th>
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['warehouseid'] ?></td>
                <td><?php echo $row['bin'] ?></td>
                <td><?php echo $row['whname'] ?></td>
                <td><?php echo $row['whemail'] ?></td>
                <td><?php echo $row['whpassward'] ?></td>
                <td><?php echo $row['whphone'] ?></td>
                <td><?php echo $row['whcity'] ?></td>
                <td class="text-center">
                    <a href="whedit.php?warehouseid=<?php echo $row['warehouseid'] ?>" class="btn btn-sm btn btn-warning">
                        <span class="glyphicon glyphicon-edit "></span>
                    </a>
                    <a href="whdelete.php?warehouseid=<?php echo $row['warehouseid'] ?>" class="btn btn-sm btn btn-danger">
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