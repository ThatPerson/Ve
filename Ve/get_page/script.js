fontsize = 12;

function up() {
	if (fontsize < 24) {
		document.getElementById("body").style.fontSize = (fontsize+1)+"pt";
		fontsize = fontsize + 1;
	}
}

function down() {
	if (fontsize > 4) {
		document.getElementById("body").style.fontSize = (fontsize-1)+"pt";
		fontsize = fontsize - 1;
	}
}

function back() {
	window.location="index.php";
}
function logout() {
	window.location="logout.php";
}
