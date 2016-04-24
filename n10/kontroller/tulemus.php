<?php
require_once ("head.html"); ?>

	<h3>Valiku tulemus</h3>
<?php
	if(!empty($_POST)){
		if(!isset($_SESSION['voted_for'])) {
			$_SESSION['voted_for'] = $_POST["pilt"];
			echo "Sinu valitud pilt: ".$_POST["pilt"];
		} else {
			echo "Oled juba valinud pildi nr " .($_SESSION["voted_for"]);

		}

	} else {
		if (isset($_SESSION['voted_for'])){
			echo "Oled juba valinud pildi nr ".$_SESSION['voted_for'];
		} else {
			echo "Tee oma valik!";
			include ("vote.html");
		}
	}
?>
<br>



<form action="?mode=lopeta_sessioon" method="POST">
	<input type="submit" value="Lõpeta sessioon!"/>
</form>
<?php

require_once ("foot.html"); ?>

