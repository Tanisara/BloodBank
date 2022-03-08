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
$email = isset($_GET['email']) ? $_GET['email'] : "";
$rid = isset($_GET['rid']) ? $_GET['rid'] : "";
if ($email != "" && $rid != "") {
    $sql = "select * from receivers where reqemail='$email' and rid='$rid'";
}
else if ($email != "") {
    $sql = "select * from receivers where reqemail='$email'";
}
else if ($rid != "") {
    $sql = "select * from receivers where rid='$rid'";
}
else {
    $sql = "select * from receivers";
}
$results = $conn->query($sql);
?>

    <h1>Blood Request System Admin <small>Reciever Data</small></h1><br>
    <h4><a href="index.php" >Blood Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="rv.php" >Reciever Data</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="req.php" >Request</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="wh.php" >Warehouse</a>
    <a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="rvadd.php" class="btn btn-primary pull-right">Add Blood</a><br><br>

    <form method="get" class="form-inline">
        Email: &nbsp;
        <input type="text" name="email" class="form-control" placeholder="email">
        ลำดับ: &nbsp;
        <input type="text" name="rid" class="form-control" placeholder="rid">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>Name</th>
                <th>Email</th>
                <th>password</th>
                <th>phone</th>
                <th>กรุ๊ป</th>
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['rid'] ?></td>
                <td><?php echo $row['rname_2'] ?></td>
                <td><?php echo $row['remail'] ?></td>
                <td><?php echo $row['rpassward'] ?></td>
                <td><?php echo $row['rphone'] ?></td>
                <td><?php echo $row['rbr'] ?></td>
                <td><?php echo $row['rcity'] ?></td>
                <td class="text-center">
                    <a href="rvedit.php?rid=<?php echo $row['rid'] ?>" class="btn btn-sm btn btn-warning">
                        <span class="glyphicon glyphicon-edit "></span>
                    </a>
                    <a href="rvdelete.php?rid=<?php echo $row['rid'] ?>" class="btn btn-sm btn btn-danger">
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