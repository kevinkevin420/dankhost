<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"></head>
<body  style="height:100%; font-family: 'Roboto', sans-serif;">
<?php 
if (isset($_SESSION['username']) || isset($_SESSION['email'])) {
    include_once("dbh.php");

    $uid = $_SESSION['username'];
    $uidEmail = $_SESSION['email'];

    $sql = "SELECT * FROM `posts` WHERE username='$uid' OR email='$uidEmail'";
    $result = mysqli_query($conn, $sql);

    
}
?>
</body>
</html>