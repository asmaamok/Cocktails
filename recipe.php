<?php
	require "database/Donnees.inc.php"; 

	$cocktail_name = $_GET['cocktail'];

	$filename = ucfirst(strtolower($cocktail_name));

	$filename = str_replace(' ', '_', $filename);
	$filename = str_replace('\'', '', $filename);
	$filename = str_replace('ñ', 'n', $filename);

	if (file_exists("include/database/Photos/".$filename.".jpg")) {
		echo "<img src='include/database/Photos/".$filename.".jpg' />";
	}



	// if there is a _ we replace it
	if (strpos($cocktail_name, "_")) {
		$cocktail_name = str_replace('_', ' ', $cocktail_name);
	}

	foreach ($Recettes as $recipe) {
		$title = $recipe['titre'];

		// Checking whether the cocktail exists
		if ($title == $cocktail_name) {
?>
			<h1><?php print_r($recipe['titre']."</br>"); ?></h1>
			<?php print_r(str_replace('|', '</br>',$recipe['ingredients']));?><br/>
			<?php print_r("</br>".$recipe['preparation']);
			break;
		}
	}
?>
<?php  

	if ( preg_match("/".$recipe['titre']."/", $_COOKIE["user_favorites"])){
		echo "<form method='post' action='#'' >";
		echo "<input name = 'cookie' value = 'remove'>";
		echo "<input type='submit' value='retirer de favoris'>";
		echo "</form>";

	}
	else{

		echo "<form method='post' action='#'' >";
		echo "<input name = 'cookie' value = 'add'>";
		echo "<input type='submit' value='Ajouter de favoris'>";
		echo "</form>";
	}

?>

	

	</form>

<?php
	function cookie_favor() {

		// if user has favorites and they're not blank
		if (isset($_COOKIE["user_favorites"])) {
			if ($_COOKIE["user_favorites"] != "") {

				// Storing them in a list
				$favorites_list = $_COOKIE["user_favorites"];
				$cocktail = explode("|", $favorites_list);

				foreach ($cocktail as $favorite) {

					// if the recipe alreaedy is in the favorites
					if ( $recipe['titre'] == $favorite) {		
						echo "L'article fait déjà partie de vos favoris!";
						break;
					}
				
				}

				$add_favor = $_COOKIE["user_favorites"]."".$recipe['titre']."|";
				setcookie("user_favorites", $add_favor, time() + 3600);
			}
		}

		else {
			// We set the cookie for an hour
			setcookie("user_favorites", $recipe['titre']."|", time() + 3600);
		}
	}

	print_r($_COOKIE);
?>
