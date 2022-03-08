<?php
require('lock.php');
require('../dbconnect.php');

$reqid1 = $_GET['reqid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reqid = $_POST['reqid'];
    $warehouseid = $_POST['warehouseid'];
    $rid = $_POST['rid'];
    $hid = $_POST['hid'];
    $br = $_POST['br'];
    $status_2 = $_POST['status_2'];

    $sql = "UPDATE vaccinereqest SET reqid = ? , warehouseid = ? , rid = ? , hid = ? , br = ? , status_2 = ? WHERE reqid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssssss', $reqid, $warehouseid, $rid,$hid,$br,$status_2,$reqid1);
    $result = $statement->execute();

    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    header('Location: req.php');
    
    exit();
}
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
        $sql = "SELECT * FROM vaccinereqest WHERE reqid = '$reqid1'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>Blood Request System: <small>Edit Request</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="reqid">Req ID</label>
            <input type="text" name="reqid" class="form-control" value="<?php echo $line['reqid']?>" require>
        </div>
        <div class="form-group">
            <label for="warehouseid">hospital</label>
            <select name="warehouseid" class="form-control">
                <?php
                $wh = $conn->query('select warehouseid, whname from warehouse');
                while($row = $wh->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['warehouseid'] ?>"><?php echo $row['whname'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="rid">Receiver</label>
            <select name="rid" class="form-control">
                <?php
                $rd = $conn->query('select rid, rname_2 from receivers');
                while($row = $rd->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['rid'] ?>"><?php echo $row['rname_2'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="hid">HID</label>
            <input type="text" name="hid" class="form-control" value="<?php echo $line['hid']?>" require>
        </div>
        
        <div class="form-group">
            <label for="br">BR</label>
            <input type="text" name="br" class="form-control" value="<?php echo $line['br']?>" require>
        </div>
        <div class="form-group">
            <label for="status_2">Status</label>
            <input type="text" name="status_2" class="form-control" value="<?php echo $line['status_2']?>" require>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"> 
        <a href="req.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>