<?php
	foreach ($Recettes as $recipe ) {
		//$title = $recipe;
		//echo $recipe["titre"];
		echo "<a href = 'index.php?p=recipe&cocktail=".$recipe["titre"]."'>".$recipe["titre"]."</a> <br>";
	}



?>
