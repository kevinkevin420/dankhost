<?php
session_start();



if (isset($_POST['submitButton'])) {
  
  include_once 'dbh.php';
  
  $pwd = mysqli_real_escape_string($conn, $_POST['password']);
  $uid = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  if (empty($pwd) || empty($uid) || empty($email)) {
    header("Location: http://localhost:8888/index.php?e=emptyS&$pwd");
    exit();
  } else {
    if (strlen($pwd) < 4) {
    header("Location: http://localhost:8888/index.php?e=password+too+short");
    exit();
    } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://localhost:8888/index.php?e=invalid+email");
        exit();
      } else {
        if (!preg_match('/^[\w]+$/', $uid)) {
           header("Location: http://localhost:8888/index.php?e=invalid+uid");
           exit();
        } else {

          $sql = "SELECT * FROM users where email = '$email' OR username = '$uid'";
          
          $result = mysqli_query($conn, $sql);
          if($result && mysqli_num_rows($result)>1){
            header("Location: http://localhost:8888/index.php?e=uid+taken");
          } else {

            $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) VALUES ('$uid', '$email', '$pwdHash')";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
          
            mysqli_close($conn);
            header("Location: http://localhost:8888/login.php?q=log+in");
            exit();
          }

          
        }
      }
    }
  }
  
  
}


if (isset($_POST['submit'])) {
  
  include_once 'dbh.php';
  
  $pwd = mysqli_real_escape_string($conn, $_POST['password']);
  $uid = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  if (empty($pwd) || empty($uid) || empty($email)) {
    header("Location: http://localhost:8888/signup.php?e=emptyS");
    exit();
  } else {
    if (strlen($pwd) < 4) {
    header("Location: http://localhost:8888/signup.php?e=password+too+short");
    exit();
    } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://localhost:8888/signup.php?e=invalid+email");
        exit();
      } else {
        if (!preg_match('/^[\w]+$/', $uid)) {
           header("Location: http://localhost:8888/signup.php?e=invalid+uid");
           exit();
        } else {

          $sql = "SELECT * FROM users where email = '$email' OR username = '$uid'";
          
          $result = mysqli_query($conn, $sql);
          if($result && mysqli_num_rows($result)>1){
            header("Location: http://localhost:8888/signup.php?e=uid+taken");
          } else {

            $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password) VALUES ('$uid', '$email', '$pwdHash')";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
          
            mysqli_close($conn);
            header("Location: http://localhost:8888/login.php?q=log+in");
            exit();
          }

          
        }
      }
    }
  }
  
  
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
<link href="/css/login.css" type="text/css" rel="stylesheet" />   
</head>
<body>
<?php if(isset($_SESSION['username']) || isset($_SESSION['email'])) {
  echo "You already have an account.";
  echo '<footer>
  <ul id="footer">
  <a id="links" href="index.php">Home</a>
  <a id="links" href="games.php">Games</a>
  <a id="links" href="music.php">Music</a>
  <a id="links" href="videos.php">Videos</a>
  </ul>
  </footer>';
  die();
} ?>
<center>
<div id="inputBox">
<form action="signup.php" method="POST">
<h2>Sign up!</h2>
<?php if(htmlspecialchars($_GET["e"]) === "emptyS"){echo "<p id='error'>A field was not entered.</p>";} 
if(htmlspecialchars($_GET["e"]) === "error"){echo "<p id='error'>Incorrect password/username. Try again.</p>";}
if(htmlspecialchars($_GET["e"]) === "password too short"){echo "<p id='error'>Password must be longer than 4 characters.</p>";}
if(htmlspecialchars($_GET["e"]) === "invalid email"){echo "<p id='error'>Please enter a valid email</p>";}
if(htmlspecialchars($_GET["e"]) === "invalid uid"){echo "<p id='error'>Username can only contain letters, numbers, and underscore.</p>";}
if(htmlspecialchars($_GET["e"]) === "uid taken"){echo "<p id='error'>Username or email is already in use.</p>";}
?>

Username: <input id="inputLogin" type="text" name="username" placeholder="Username..." /><br>
Email: &nbsp &nbsp &nbsp  <input id="inputLogin" type="text" name="email" placeholder="Email..." /><br>
Password: <input id="inputLogin" type="password" name="password" placeholder="Password..." /><br>
<button id="submitButton" name="submit" type="submit">Sign Up</button>
</div>
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