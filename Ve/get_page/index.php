<?php
	include("../database.php");
	include("simple_html_dom.php");
	
	function get_page($url) {
		$html = file_get_html($url);
		$curr = 0;
		$cont = "";
		$curr_2 = 0;
		$cont_2 = "";
		foreach($html->find('div') as $element) {
			$p_c = strlen($element->innertext);
			if ($p_c > $curr) {
				$cont = $element->innertext;
				$curr = $p_c;
			}
		//$p_c = strlen($element->innertext)-strlen(str_replace(' ', '', $element->innertext));
		//if ($p_c > 2) 
			//echo $element->innertext .'<br>';
		}
		$cont = preg_replace("/<ul[^>]+>[^<]+<\/ul>/", "", $cont);
		$cont = str_replace("<img", "<img class='pic'", $cont);
	
		$cont_e = strpos($cont, "<h1");
		$cont_b = strpos($cont, "<h3", $cont_e);
		$cont = substr($cont, $cont_e, $cont_b-$cont_e);
		$cont = str_replace("</div>", "", $cont);
		$cont = preg_replace("/<div [^>]+>/", "", $cont);
		$arr = array();
		$arr[] = $cont;
		foreach($html->find('title') as $element) {
			
			$title = $element->innertext;
		}
		$arr[] = $title;
		return $arr;
	}
	
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
	
	if (isset($_GET['de'])) {
		$qu = "delete from ve_pages where user_id = '".$userid."' and id = '".$mysqli->real_escape_string($_GET['de'])."'";
		$mysqli->query($qu);
	}
	
	if (isset($_GET['url'])) {

		$p = get_page($_GET['url']);

		$q = "insert into ve_pages (url, title, user_id, page) values ('".$mysqli->real_escape_string($_POST['url'])."', '".$mysqli->real_escape_string($p[1])."', '".$userid."', '".$mysqli->real_escape_string($p[0])."')";
		$mysqli->query($q);
	}
	
	$uqe = "select * from ve_pages where user_id = '".$userid."' order by timestamp desc";
	$rio = $mysqli->query($uqe);
	
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
			<div class="back" onclick='window.location="logout.php";'>
			</div>
			<form action="index.php" method="get">
				<input type="text" id="search" placeholder="URL..." name="url">
			</form>
			

		</div>
		</div>
		<div class="container">
			<div class="objects">
			<?
				for ($i = 0; $i < $rio->num_rows; $i++) {
					$rio->data_seek($i);
					$row_no = $rio->fetch_assoc();
					?>
						<div class="item">
							<h3><? echo $row_no["title"]; ?></h3><br>
							<p class="italic"><? echo $row_no["timestamp"]; ?></p>
							<p><? echo substr(strip_tags($row_no["page"]), 0, 100); ?></p><br>
							<a href="page.php?id=<? echo $row_no['id']; ?>">Click here</a><br>
							<a href="index.php?de=<?php echo $row_no['id']; ?>">Delete</a>
						</div>
					
					<?	
				}
			?>
			</div>
		</div>
	</body>
</html>
	
