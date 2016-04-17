<?php
require_once ("head.html")
?>


	<h3>Fotod</h3>
	<div id="gallery">
		<?php

		$pildid = array(
			array("src"=>"pildid/nameless1.jpg", "id"=>"p1", "value"=>"1", "alt"=>"nimetu 1"),
			array("src"=>"pildid/nameless2.jpg", "id"=>"p2", "value"=>"2", "alt"=>"nimetu 2"),
			array("src"=>"pildid/nameless3.jpg", "id"=>"p3", "value"=>"3", "alt"=>"nimetu 3"),
			array("src"=>"pildid/nameless4.jpg", "id"=>"p4", "value"=>"4", "alt"=>"nimetu 4"),
			array("src"=>"pildid/nameless5.jpg", "id"=>"p5", "value"=>"5", "alt"=>"nimetu 5"),
			array("src"=>"pildid/nameless6.jpg", "id"=>"p6", "value"=>"6", "alt"=>"nimetu 6")
		);


?>
		<?php
		foreach ($pildid as $pilt) {
			echo "<img src = \" {$pilt["src"]} \" alt = \" {$pilt["alt"]} \" />";
		}
		?>


	</div>
<?php
require_once ("foot.html")
?>
