<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rid = $_POST['rid'];
    $rname_2 = $_POST['rname_2'];
    $remail = $_POST['remail'];
    $rpassword = $_POST['rpassword'];
    $rphone = $_POST['rphone'];
    $rbr = $_POST['rbr'];
    $rcity = $_POST['rcity'];

    $sql = "insert into receivers (rid, rname_2, remail,rpassword,rphone,rbr,rcity) values (?,?,?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssssss', $rid, $rname_2, $remail,$rpassword,$rphone,$rbr,$rcity);
    $result = $statement->execute();

    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    header('Location: rv.php');
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

    <h1>Blood Request System: <small>Add Receiver Data</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="rid">ลำดับ</label>
            <input type="text" name="rid" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="rname_2">Name</label>
            <input type="text" name="rname_2" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="remail">Email</label>
            <input type="text" name="remail" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="rpassword">Password</label>
            <input type="text" name="rpassword" class="form-control" require>
        </div>
        
        <div class="form-group">
            <label for="rphone">Phone</label>
            <input type="text" name="rphone" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="rbr">กรุ๊ป</label>
            <input type="text" name="rbr" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="rcity">City</label>
            <input type="text" name="rcity" class="form-control" require>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"> 
        <a href="rv.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>