<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head><title>Upload</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />

<link href="/css/upload.css" type="text/css" rel="stylesheet" />   
</head>
<body>

<center>
<?php
if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
    # code to run if logged in
} else {
    $referRef = "http://".htmlspecialchars($_SERVER['HTTP_HOST'])."".htmlspecialchars($_SERVER['REQUEST_URI'])."";
    # $referRef = htmlspecialchars($refer);
    ini_set('display_errors', 1);
    
    //header("Location: http://localhost:8888/login.php?q=log+in&refer=".$referRef."");
    
    echo '<script type="text/javascript">';
    echo 'window.location.href="http://localhost:8888/login.php?q=log+in&refer='.$referRef.'";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=http://localhost:8888/login.php?q=log+in&refer='.$referRef.'" />';
    echo '</noscript>';

    die();
}
?>
<div id="inputBox">

</div>
</center>
</body>
</html>