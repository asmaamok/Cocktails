<?php
	include "include/database/Donnees.inc.php"; 
?>
	<h2>Recherche d'ingrédients</h2>
<?php

	$end = null;

	// if there is a research, it gets the priority
	if (isset($_GET["search"]) && $_GET["search"] != "") {
		search_recipe($_GET["search"]);
	}

	else {
		// we check whether an ingredient has been sent
		if (isset($_POST["ingredient"])) {
			$ingredient = $_POST["ingredient"];
			$string = $_COOKIE["history"];
		}

		else {
			// $ingredient = "Liqueur de fruit";
			// $ingredient = "Sirop de roses";
			$ingredient = "Aliment";
			$string = "";
		}

		// we display the list
		$string = $string." >".$ingredient;
		setcookie("history", $string , time() + 60); // cookie expires in 1 minute

		echo $string;

		echo "<form method='post' action='#' >";
		ingredients_list($ingredient);

		// if ($end != true) {
?>
		<br/><input type='submit' value='Approfondir la recherche'>
		</form>

		<a href = 'index.php?p=search&search=<?php echo $ingredient;?>'>&nbsp;Rechercher&nbsp;avec&nbsp;<?php echo $ingredient;?></a>


<?php


		// }
	}

	// class to search from an ingredient
	function ingredients_list($ingredient) {

		include "include/database/Donnees.inc.php";

		if ((sizeof($Hierarchie[$ingredient])) != 1  || $ingredient == "Aliment") {

			// reading the sub-category
			echo "<h3>Liste ingrédients</h3>";

			foreach ($Hierarchie[$ingredient]["sous-categorie"] as $element) {

				// let the user choose ingredients
				print_r('<input type="radio" name="ingredient" value="'.$element.'">'.$element.'</br>');
			}
		}

		else {
			echo "Désolé, nous ne pouvons pas être plus précis!";
		}
	}


	// searching recipes
	function search_recipe($ingredient) {

		include "include/database/Donnees.inc.php"; 

		// if we search the term "Aliment"
		if ($ingredient == "Aliment") {
			foreach ($Recettes as $recipe) {
				echo "<a href = 'index.php?p=recipe&cocktail=".$recipe["titre"]."'>+ ".$recipe["titre"]."";
				echo "<br/>";
			}
		}

		// if we search an ingredient at the end of the root
		elseif ((sizeof($Hierarchie[$ingredient])) == 1 || $ingredient == "Aliment") {

			echo "Les recettes qui contiennent&nbsp;\"".$ingredient."\"&nbsp;sont&nbsp;:&nbsp;</br> ";

			foreach ($Recettes as $recipe) {
				foreach ($recipe["index"] as $element) {

					if ($element == $ingredient) {
						echo "<a href = 'index.php?p=recipe&cocktail=".$Recettes["titre"]."'>+ ".$Recettes["titre"]."";
						echo "<br/>";
					}
				}
			}
		}

		// if we search an intermediate ingredient
		elseif ((sizeof($Hierarchie[$ingredient])) == 2) {

//------------------------------------------------------------

			$cocktail_iste ="";
			$list_ingredients ="";
			$array_name = array();
			//echo $ingredient;
			//$ingrediant_liste = search_all_ingredients($ingredient);
			//print_r( $ingrediant_liste);

			//$component = preg_split("/\|/", search_all_ingredients($ingredient));

			$list_ingredients .= search_all_ingredients($ingredient, $list_ingredients);
			echo "ettx = ".$list_ingredients;
			//print_r($array_name);
			//echo "liste =".$list_ingredients;
			/*
			foreach ($component as $key ){

				foreach ($Recettes as $recipe) {
					foreach ($recipe["index"] as $element) {

						if ($element == $key) {
							if (!preg_match("/".$recipe["titre"]."/", $cocktail_iste)) {
								$cocktail_iste .= $recipe["titre"];
								//echo $recipe["titre"]."<br>";
								//echo "<a href = 'index.php?p=recipe&cocktail=".$recipe["titre"]."'>+ ".$recipe["titre"]."<br>";


							}
						}
						
					}
				}

				

			} */
		}

		//-----------------------------------------------------------
	}

	function search_all_ingredients($class_aliment,$list_ingredients){

		include "include/database/Donnees.inc.php"; 
;
		// on test que l'ingrediant donne est bien un super/sous cat
		if (sizeof($Hierarchie[$class_aliment]) == 2) {
			// lit les ingredient de la sout cat
			foreach ($Hierarchie[$class_aliment]['sous-categorie'] as $ingredient_element) {
						//on test que cesingrediant possede bien une sous/sur cat
						if (sizeof($Hierarchie[$ingredient_element]) == 1) {
							if (!preg_match("/".$ingredient_element."/", $list_ingredients)) {

								$list_ingredients .= "|".$ingredient_element;
								return $list_ingredients;


							}


							//echo $ingredient_element."<br>";
						}
						else{
							search_all_ingredients($ingredient_element,$list_ingredients );

						}
	
		}

	}
	else
	{
		//array_push($array_name, $ingredient_element);
		$list_ingredients = $list_ingredients."|".$class_aliment;
		return $list_ingredients;

	}
	
	echo "pinkie = ". $list_ingredients."<br>" ;
	//setcookie("branches",$list_ingredients,time()+60);
	//return $list_ingredients;

}


?>