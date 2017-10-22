<?php include_once "header.php";

?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="/css/main.css" type="text/css" rel="stylesheet" /> 
<script>
function showSidebar() {
    var x = document.getElementById('sidebarDiv');
    var show = document.getElementById('showImg');
    var hide = document.getElementById('hideImg');
    if (x.style.display === 'none') {
        x.style.display = 'block';
        show.style.display = 'none';
        hide.style.display = 'block';
        
    } else {
        x.style.display = 'none';
        hide.style.display = 'none';
        show.style.display = 'block';

    }

}


</script>

</head>
<body>
<!-- New sidebar/bottom bar -->

<div id="sidebarDiv">
<a id="sidebarLink" href="/index.php">Home</a><br>
<a id="sidebarLink" href="/games.php">Games</a><br>
<a id="sidebarLink" href="/music.php">Music</a><br>
<a id="sidebarLink" href="/videos.php">Videos</a><br>
<a id="sidebarLink" href="/chat.php">Chat</a><br>
<a id="sidebarLink" href="/forum.php">Forum</a><br>
<a id="sidebarLink" href="/account.php">Account</a><br>
<?php 
if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
   echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><a id="logout" href="/logout.php">Log Out</a><br>';
}    
?>
</div>
<?php 
if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
# code to run if logged in  
}
?>
<img onload="showSidebar()" id="hideImg" src="https://maxcdn.icons8.com/Share/icon/androidL/Arrows//back1600.png" onclick="showSidebar();"></img>
<img id="showImg" src="https://cdn3.iconfinder.com/data/icons/32-fufficon/32/32x32_fluffy-03-512.png" onclick="showSidebar();"></img>
<div id="mainBox">
<h1>Hello and welcome to <a href="/index.php">my website!</a></h1>
<p> Here you can play games, upload videos, music and more! </p>
<?php if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
    echo "<p id='success'>You are logged in!</p>";
    include_once("front-page-user.txt");
} else {
    include_once("front-page-login.txt");
}
?>

<div style="height: 340px" id="inputBox">
<h2> Quick Links </h2>
<ul>
<li><a id="links" href="index.php">Home</a></li>
<li><a id="links" href="games.php">Games</a></li>
<li><a id="links" href="music.php">Music</a></li>
<li><a id="links" href="videos.php">Videos</a></li>
<li><a id="links" href="forum.php">Forum</a></li>
<li><a id="links" href="chat.php">Chat</a></li>
</ul>
</div>




</body>
</html>