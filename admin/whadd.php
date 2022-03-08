<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $warehouseid = $_POST['warehouseid'];
    $bin = $_POST['bin'];
    $whname = $_POST['whname'];
    $whemail = $_POST['whemail'];
    $whpassward = $_POST['whpassward'];
    $whphone = $_POST['whphone'];
    $whcity = $_POST['whcity'];

    $sql = "insert into warehouse (warehouseid, bin, whname,whemail,whpassward,whphone,whcity) values (?,?,?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssssss', $warehouseid, $bin, $whname,$whemail,$whpassward,$whphone,$whcity);
    $result = $statement->execute();

    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    header('Location: wh.php');
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

    <h1>Blood Request System: <small>Add hospital</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="warehouseid">hospital ID</label>
            <input type="text" name="warehouseid" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="bin">ลำดับ</label>
            <select name="bin" class="form-control">
                <?php
                $bn = $conn->query('select bin from vaccineinfo');
                while($row = $bn->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['bin'] ?>"><?php echo $row['bin'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="whname">hospital name</label>
            <input type="text" name="whname" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="whemail">Email</label>
            <input type="text" name="whemail" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="whpassward">Password</label>
            <input type="text" name="whpassward" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="whphone">Phone</label>
            <input type="text" name="whphone" class="form-control" require>
        </div>
        <div class="form-group">
            <label for="whcity">City</label>
            <input type="text" name="whcity" class="form-control" require>
        </div>
        <input class="btn btn-primary" type="submit" value="Save"> 
        <a href="wh.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>