<?php 
include_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
<link href="/css/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php 
if (empty($_SESSION['username']) || empty($_SESSION['email'])) {
    $refer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $referRef = htmlspecialchars($refer);
    header("Location: http://localhost:8888/login.php?q=log+in&refer=$referRef");
    die();

} else {
    // code to run if user is logged in
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}

?>
<h1>Welcome, <b style="color: darkgrey;"> <?php echo $username; ?></b>.</h1>  


</body>
</html>