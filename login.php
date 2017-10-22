<?php

session_start();

if(empty(htmlspecialchars($_GET["refer"]))){} else {
	$referLink = htmlspecialchars($_GET["refer"]);
}

if (isset($_POST['submitButton'])) {
	
	include 'dbh.php';

	$uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?e=empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username='$uid' OR email='$uid'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        

		if ($resultCheck < 1) {
			header("Location: ../index.php?e=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
	
            $hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?e=error");
					exit();
				} elseif ($hashedPwdCheck == true) {
					$_SESSION['email'] = $row['email'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['type'] = $row['type'];
					$_SESSION['ip'] = htmlspecialchars($_SERVER['REMOTE_ADDR']);
					$_SESSION['date'] = date("Y-m-d");
						header("Location: ../index.php?q=success");
						exit();
					}
				}
			}
		}
} else {
}

if (isset($_POST['submit'])) {
	
	include 'dbh.php';

	$uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	if (empty($uid) || empty($pwd)) {
		header("Location: ../login.php?e=empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username='$uid' OR email='$uid'";
		$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        

		if ($resultCheck < 1) {
			header("Location: ../login.php?e=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
	
            $hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../login.php?e=error");
					exit();
				} elseif ($hashedPwdCheck == true) {
						$_SESSION['email'] = $row['email'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['type'] = $row['type'];
						$_SESSION['ip'] = htmlspecialchars($_SERVER['REMOTE_ADDR']);
						$_SESSION['date'] = date("Y-m-d");
						header("Location: ../index.php?q=success");
						exit();
					}
				}
			}
		}
	} else {
}
?>

<!DOCTYPE html>
<html>
<head><title>Log In</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />

<link href="/css/login.css" type="text/css" rel="stylesheet" />   
</head>
<body>
<center>
<div id="form">
<?php if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
	echo "<p id='success'>You are logged in. Click <a id='links' href='/logout.php'>here</a> to logout.</p>";
	echo '<footer>
	<ul id="footer">
	<a id="links" href="index.php">Home</a>
	<a id="links" href="games.php">Games</a>
	<a id="links" href="music.php">Music</a>
	<a id="links" href="videos.php">Videos</a>
	</ul>
	</footer>
	</center>
	</body>
	</html>
	';
	die();
}
?>
<form action="login.php" method="POST">
<div id="inputBox">

<h2>Log in!</h2>
<?php if(htmlspecialchars($_GET["e"]) === "empty"){echo "<p id='error'>A field was not entered.</p>";} 
if(htmlspecialchars($_GET["e"]) === "error"){echo "<p id='error'>Incorrect password/username. Try again.</p>";}
if(htmlspecialchars($_GET["q"]) === "log in"){echo "<p id='success'>Please log in to continue.</p>";}


echo "<br>";
?>
Username: <input id="inputLogin" type="text" name="username" placeholder="Username..." /><br>
Password: <input id="inputLogin" type="password" name="password" placeholder="Password..." /><br>
<button id="submitButton" name="submit" type="submit">Log In</button>
</form><br>

<p>Don't have an account? Sign up <a id="links" href="signup.php">here</a>! </p>
</div>
<div>
<footer>
<ul id="footer">
<a id="links" href="index.php">Home</a>
<a id="links" href="games.php">Games</a>
<a id="links" href="music.php">Music</a>
<a id="links" href="videos.php">Videos</a>
</ul>
</footer>
</div>
</center>

</body>
</html>