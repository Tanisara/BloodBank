<?php
require('lock.php');
require('../dbconnect.php');

$warehouseid = $_GET['warehouseid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from warehouse where warehouseid = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $warehouseid);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
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

    <h1>Blood Request System: <small>Delete hospital</small></h1>

    <?php
    $sql = "select warehouseid from warehouse where warehouseid = $warehouseid";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $warehouseid = $row['warehouseid'];
    ?>
    <p>Are you sure you want to delete '<?php echo $warehouseid ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="rv.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>