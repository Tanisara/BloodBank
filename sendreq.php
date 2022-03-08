<?php
require('session.php');
require('dbconnect.php');

$hid = $_GET['hid'];
$br1=$conn->query("SELECT * FROM vaccineinfo WHERE hid = '$hid'");
$br2 = $br1->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $warehouseid = $_POST['warehouseid'];
    $rid = $_POST['rid'];
    $br = $br2['br'];

    $sql = "insert into vaccinereqest(warehouseid, rid,hid,br) values (?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssss',$warehouseid, $rid,$hid,$br);
    $result = $statement->execute();

    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    header('Location: request.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Vaccine Request System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>Vaccine Request System: <small>Vaccine Request</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="warehouseid">Warehouse</label>
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
            <input type="text" name="hid" class="form-control" value="<?php echo $hid ?>" disabled require>
        </div>
        <div class="form-group">
            <label for="br">BR</label>
            <input type="text" name="br" class="form-control" value="<?php echo $br2['br'] ?>" disabled require>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>