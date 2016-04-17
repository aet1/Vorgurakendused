<?php
require_once ("head.html"); ?>

	<h3>Valiku tulemus</h3>
<?php
if(!empty($_POST)){
	echo "Sinu valitud pilt: ".$_POST["pilt"];
} else {
	echo "Vali pilt!";
}
?>



<?php
require_once ("foot.html"); ?>