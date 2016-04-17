<?php
require_once ("head.html");

$pildid = array(
	array("src"=>"pildid/nameless1.jpg", "id"=>"p1", "value"=>"1", "alt"=>"nimetu 1"),
	array("src"=>"pildid/nameless2.jpg", "id"=>"p2", "value"=>"2", "alt"=>"nimetu 2"),
	array("src"=>"pildid/nameless3.jpg", "id"=>"p3", "value"=>"3", "alt"=>"nimetu 3"),
	array("src"=>"pildid/nameless4.jpg", "id"=>"p4", "value"=>"4", "alt"=>"nimetu 4"),
	array("src"=>"pildid/nameless5.jpg", "id"=>"p5", "value"=>"5", "alt"=>"nimetu 5"),
	array("src"=>"pildid/nameless6.jpg", "id"=>"p6", "value"=>"6", "alt"=>"nimetu 6")
);
?>


	<h3>Vali oma lemmik :)</h3>
	<form action="tulemus.php" method="GET">
		<?php
		foreach ($pildid as $pilt) {
			echo "<p>
<label for={$pilt["id"]}>
						<img src = \" {$pilt["src"]} \" alt = \" {$pilt["alt"]} \" />
						<input type = \"radio\" value = \"{$pilt["value"]}\" id = \" {$pilt["id"]} \" name = \"pilt\" />
			</label>
			</p>";
		}
		?>


		<br/>
		<input type="submit" value="Valin!"/>
	</form>

<?php
require_once ("foot.html")
?>