<?php
	include("simple_html_dom.php");
	include("../database.php");
	$userid = 0;
	if (isset($_COOKIE['un']) && isset($_COOKIE['pn'])) {
		$qu = "select * from ve_users where username = '".$mysqli->real_escape_string($_COOKIE['un'])."' and password = '".$mysqli->real_escape_string($_COOKIE['pn'])."'";
		$r = $mysqli->query($qu);
		
		if ($r->num_rows != 1) {
			header("Location: ../login.php");
			exit(0);
		} else {
			$r->data_seek(0);
			$row_no = $r->fetch_assoc();
			$userid = $row_no["id"];
		}
	}
	$resp = "";
	if (isset($_GET['id'])) {
		$rio = $mysqli->query("select * from ve_pages where id = '".$mysqli->real_escape_string($_GET['id'])."' and user_id = '".$userid."'");

		for ($i = 0; $i < $rio->num_rows; $i++) {
			echo "Hello";
			$rio->data_seek($i);
			$row_no = $rio->fetch_assoc();
			$resp = "<h1>".$row_no["title"]."</h1><p class='italic'>".$row_no["timestamp"]."</p><p>".$row_no["page"]."</p>";
		}
	} else {
		exit(0);
	}
?>
<!doctype html>
<html>
	<head>
		<title>NotNow</title>
		<link href='style.css' rel='stylesheet' type='text/css'>
		<script src="script.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body id="body">
		<div class="header">
			<div class="back" onclick="back()">
			</div>
			<div class="right">
				<div class="bigger" onclick="up()">
				</div>
				<div class="smaller" onclick="down()">
				</div>

			</div>

		</div>
		</div>
		<div class="container">
			<? echo $resp ?>
		</div>
	</body>
</html>
