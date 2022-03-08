<?php
require('lock.php');
require('../dbconnect.php');

$bin1 = $_GET['bin'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $bin = $_POST['bin'];
    $hid = $_POST['hid'];
    $br = $_POST['br'];

    // Prepare sql and bind parameters
    $sql = "UPDATE vaccineinfo SET bin = ? , hid =? , br = ? , date = ? WHERE bin = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('ssss', $bin,$hid,$br,$bin1);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    
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
        $sql = "SELECT * FROM vaccineinfo WHERE bin = '$bin1'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>Blood Request System: <small>Edit Blood Data</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="bin">ลำดับ</label>
            <input type="text" name="bin" class="form-control" value="<?php echo $line['bin']?>">
        </div>
        <div class="form-group">
            <label for="hid">รหัสเลือด</label>
            <input type="text" name="hid" class="form-control" value="<?php echo $line['hid'] ?>">
        </div>
        <div class="form-group">
            <label for="br">กรุ๊ป</label>
            <input type="text" name="br" class="form-control" value="<?php echo $line['br'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" value="Edit Vaccine"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>