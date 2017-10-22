<?php include_once "header.php"; 
session_start();
?>
<!DOCTYPE html>
<html>
<head><link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"></head>
<body  style="height:100%; font-family: 'Roboto', sans-serif;">
<?php 
print_r($_SESSION);
if (isset($_SESSION['username']) || isset($_SESSION['email'])) {
    include_once "dbh.php";

    $uid = $_SESSION['username'];
    $email = $_SESSION['email'];
    
    $sql = "SELECT * FROM favorites WHERE username='$uid' or email='$email'";

    $result = mysqli_query($conn, $sql);
    echo  mysqli_fetch_array($result);

    while ($row = mysqli_fetch_array($result)) {
        echo '<tr>';
        foreach($row as $field) {
            echo '<td>' . htmlspecialchars($field) . '</td>';
        }
        echo '</tr>';
    }
   
    mysqli_close($conn);
}
?>
</body>
</html>