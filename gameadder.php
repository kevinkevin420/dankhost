<?php 
session_start();
if(isset($_POST['submit'])) {
if (isset($_SESSION['username'])) {
    if($_SESSION['type'] === 'superadmin') {
        include_once 'dbh.php';

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $titlens = mysqli_real_escape_string($conn, $_POST['titlens']);
        $embed = $_POST['embed'];

ini_set('upload_max_filesize', '10000M');
ini_set('post_max_size', '10000M');
ini_set('max_execution_time', '9000'); 
ini_set('memory_limit', '20000M');
	if (isset($_POST['submit'])) {
		if (empty($_POST["title"])) {
			echo '<p> You did not enter a title! </p>';
		} else {
		$file = $_FILES['file'];
		
		$fileName = $_FILES['file']['name'];
	    $fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
		$fileTitle = $_POST['titlens'];


		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'gif', 'tiff');

		if(in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 200000000) {
					$fileNameNew = $title.".".$fileActualExt;
                    $uploadDir = "/images/games/";
                    $fileDestination = $uploadDir . basename($titlens);

					move_uploaded_file($_FILES['file']['tmp_name'], __DIR__ . $fileDestination);

					$handle = fopen('gamelist.html', 'a');

					fwrite($handle, '<a id="gameImgLink" href="/games/'.$titlens.'.php"><img id="gameImg" src="'.$fileDestination.'"><img></a>'."\n");

					fclose($handle);

                    $gameFile = fopen(__DIR__ . "/games/$titlens.php", "w") or die("Unable to open file!");
                    $txt = "<?php include_once \"header.php\"; ?>
                    <!DOCTYPE html>
                    <html>
                    <head>
                    <link rel=\"shortcut icon\" href=\"/images/favicon.ico\" type=\"image/x-icon\">
                    <link rel=\"stylesheet\" href=\"/css/games.css\" type=\"text/css\">
                    <link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\"> <meta charset=\"utf-8\" /><meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
                    <title>$title</title>
                    </head>
                    
                    <body>   
                    
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
                    
                    
                    function secretMode() {
                            document.cookie = \"secretMode=1\";
                            var link = document.querySelector(\"link[rel*='icon']\") || document.createElement('link');
                            link.type = 'image/x-icon';
                            link.rel = 'shortcut icon';
                            link.href = 'https://ssl.gstatic.com/classroom/favicon.png';
                            document.getElementsByTagName('head')[0].appendChild(link);
                            document.title = \"Classroom\";
                    
                            document.getElementById( \"secretMode\" ).setAttribute( \"onClick\", \"secretModeDisable();\" );
                    }
                    function secretModeDisable() {
                            document.cookie = \"secretMode=0\";
                            var link = document.querySelector(\"link[rel*='icon']\") || document.createElement('link');
                            link.type = 'image/x-icon';
                            link.rel = 'shortcut icon';
                            link.href = 'https://ssl.gstatic.com/classroom/favicon.png';
                            document.getElementsByTagName('head')[0].appendChild(link);
                            document.title = \"$title\";
                    
                            document.getElementById( \"secretMode\" ).setAttribute( \"onclick\", \"secretMode();\" );
                    }
                    
                    
                    
                    </script>
                    <img onload=\"showSidebar();\" id=\"hideImg\" src=\"https://maxcdn.icons8.com/Share/icon/androidL/Arrows//back1600.png\" onclick=\"showSidebar();\"></img>
                    <img onload=\"showSidebar();\" id=\"showImg\" src=\"https://cdn3.iconfinder.com/data/icons/32-fufficon/32/32x32_fluffy-03-512.png\" onclick=\"showSidebar();\"></img>
                    <center>
                      <div id=\"sidebarDiv\">
                    <a id=\"sidebarLink\" href=\"/index.php\">Home</a><br>
                    <a id=\"sidebarLink\" href=\"/games.php\">Games</a><br>
                    <a id=\"sidebarLink\" href=\"/music.php\">Music</a><br>
                    <a id=\"sidebarLink\" href=\"/videos.php\">Videos</a><br>
                    <a id=\"sidebarLink\" href=\"/chat.php\">Chat</a><br>
                    <a id=\"sidebarLink\" href=\"/forum.php\">Forum</a><br>
                    <a id=\"sidebarLink\" href=\"/account.php\">Account</a><br>
                    <?php
                    if(isset(\$_SESSION['username']) || isset(\$_SESSION['email'])) {
                       echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><button id=\"secretMode\" onClick=\"secretMode();\" >Secret Mode</button><br><br><br><a id=\"logout\" href=\"/logout.php\">Log Out</a><br>';
                    }   
                    ?>
                    </div>
                    <h1>$title</h1>
                    
                    $embed
                    <br><br>
                    
                    
                    <footer>
                        <ul id=\"footer\">
                        <a id=\"links\" href=\"/index.php\">Home</a>
                        <a id=\"links\" href=\"/games.php\">Games</a>
                        <a id=\"links\" href=\"/music.php\">Music</a>
                        <a id=\"links\" href=\"/videos.php\">Videos</a>
                            </ul>
                    </footer>
                    </center>
                    </body> 
                    </html>
                            ";
                    fwrite($gameFile, $txt);
                    fclose($gameFile);
            
					header("Location: admin.php?upload-success");
				} else {
					echo "<p> Your file is too big! </p>";
				}

			} else {
                echo "<p> There was an error uploading your file!";
			}

		} else {
			echo "<p> You cannot upload files of this type. </p>";
		}
	}
	}
	



        }
    }
}
header("Location: /admin.php");
exit();
?>