<?php
require('lock.php');
require('../dbconnect.php');

$rid1 = $_GET['rid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rid = $_POST['rid'];
    $rname_2 = $_POST['rname_2'];
    $remail = $_POST['remail'];
    $rpassword = $_POST['rpassword'];
    $rphone = $_POST['rphone'];
    $rbr = $_POST['rbr'];
    $rcity = $_POST['rcity'];

    $sql = "UPDATE receivers SET rid = ? , rname_2 = ? , remail = ? , rpassword = ? , rphone = ? , rbr = ? , rcity = ? WHERE rid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssssssss', $rid, $rname_2, $remail,$rpassword,$rphone,$rbr,$rcity,$rid1);
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
        $sql = "SELECT * FROM receivers WHERE rid = '$rid1'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>Blood Request System: <small>Edit Blood Data</small></h1>

    <form method="post" class="form">
    <div class="form-group">
            <label for="rid">ลำดับ</label>
            <input type="text" name="rid" class="form-control" value="<?php echo $line['rid']?>" require>
        </div>
        <div class="form-group">
            <label for="rname_2">Name</label>
            <input type="text" name="rname_2" class="form-control" value="<?php echo $line['rname_2']?>" require>
        </div>
        <div class="form-group">
            <label for="remail">Email</label>
            <input type="text" name="remail" class="form-control" value="<?php echo $line['remail']?>" require>
        </div>
        <div class="form-group">
            <label for="rpassword">Password</label>
            <input type="text" name="rpassword" class="form-control" value="<?php echo $line['rpassword']?>" require>
        </div>
        
        <div class="form-group">
            <label for="rphone">Phone</label>
            <input type="text" name="rphone" class="form-control" value="<?php echo $line['rphone']?>" require>
        </div>
        <div class="form-group">
            <label for="rbr">กรุ๊ป</label>
            <input type="text" name="rbr" class="form-control" value="<?php echo $line['rbr']?>" require>
        </div>
        <div class="form-group">
            <label for="rcity">City</label>
            <input type="text" name="rcity" class="form-control" value="<?php echo $line['rcity']?>" require>
        </div>
        <input class="btn btn-primary" type="submit" value="Edit Vaccine"> 
        <a href="rv.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>