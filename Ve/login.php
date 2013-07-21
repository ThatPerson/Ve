<?php

	include("database.php");
	if (isset($_COOKIE['un']) && isset($_COOKIE['pn'])) {
		$qu = "select * from ve_users where username = '".$mysqli->real_escape_string($_COOKIE['un'])."' and password = '".$mysqli->real_escape_string($_COOKIE['pn'])."'";
		$r = $mysqli->query($qu);
		if ($r->num_rows == 1) {
			header("Location: get_page/index.php");
			exit(0);
		}
	}
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $que = "select id from ve_users where username = '".$mysqli->real_escape_string($_POST['username'])."' and password = '".$mysqli->real_escape_string($_POST['password'])."'";
    $r = $mysqli->query($que);
    if ($r->num_rows == 1) {
      setcookie("un", $_POST['username'], time()+3600);
      setcookie("pn", $_POST['password'], time()+3600);
      header("Location: get_page/index.php");
    } else {
      echo "Failed";
    }
  }
?>
<!doctype html>
<html>
  <head>
    <title>Login</title>
    <script src="script.js">
    </script>
    <link href='get_page/style.css' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>

    	<div class="header">

				<input type="text" id="search" value="Ve" name="url" readonly>



		</div>
		</div>
		<div class="container">
			<div class="objects">
				<form method="post" action="login.php" id="form">
    				<input id="un" type="text" placeholder="Username" name="username"><br>
     				<input id="pn" type="password" placeholder="Password" name="password"><br>
     				<input type="button" onclick="senddata()" value="Login">
     			</form>
			</div>
		</div>
  </body>
</html>
