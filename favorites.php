<?php
	if (isset($_COOKIE["connected_user"])) {

		include("include/users/".$_COOKIE["connected_user"].".php");

		// if user is connected
		if ($_COOKIE["connected_user"] != "") {
			/*
			if (isset($_COOKIE["user_favorites"]) ){
				$favorite = preg_split("/|/", $_COOKIE["user_favorites"])
				$new_favorites = $_COOKIE["user_favorites"];


				foreach ($favorite as $cookie_favorites) {
					if (!preg_match("/". $cookie_favorites."/", $new_favorites)){
						$new_favorites .= "|".$cookie_favorites;
					}

				}

				$username = $user["username"];
				$password = $user["password"];
				$surname = $user["surname"];
				$firstname = $user["firstname"];
				$gender = $user["gender"];
				$birthday = $user["birthday"];
				$email = $user["email"]; 
				$phone = $user["phone"];
				$address = $user["address"];	
				$postalcode = $user["postalcode"];	
				$city = $user["city"];
				$favorites = $new_favorites;


				// Calling connected user's credentials file
				$filename = "include/users/".$_COOKIE["connected_user"].".php";

				// the w+ right empties said file
				$file = fopen($filename, "w+");

				// we then rewrite everything into that file: might be trivial but at least it works ;)
				fputs($file, "<?php \n");
				fputs($file, "\$user = array( \n");
				fputs($file,"'username' => '".$username."',\n");
				fputs($file,"'password' => '".$new_password."',\n");
				fputs($file,"'surname' => '".$new_name."',\n");
				fputs($file,"'firstname' => '".$new_firstname."',\n");			
				fputs($file,"'gender' => '".$gender."',\n");
				fputs($file,"'birthday' => '".$new_birthday."',\n");
				fputs($file,"'email' => '".$new_email."',\n");
				fputs($file,"'phone' => '".$new_phone."',\n");
				fputs($file,"'address' => '".$new_address."',\n");
				fputs($file,"'postalcode' => '".$new_postalcode."',\n");
				fputs($file,"'city' => '".$new_city."',\n");
				fputs($file,"'favorites' => '".$favorites."'\n");
				fputs($file, ");\n");

				// we close the file at the end
				fclose($file);

			}
			*/

			// if connected user has no favorites
			if ($user['favorites'] == "") {

				// inform him about it
				echo "Vous n'avez pas encore de cocktail favori!<br/>";
				echo "Vous pouvez découvrir nos suggestions dans le magasin<br/>";
				echo "ou chercher un cocktail avec votre aliment préféré";
			}

			// if user does have favorites
			else {
				// store them in a list
				$favorites_list = $user['favorites'];

				// split the list
				if (preg_match("/|/", $favorites_list)) {

					$coktail = explode("|", $favorites_list);

					foreach ($coktail as $favorite) {
						if ($favorite != "") {

							// we link the element to display the recipe
							echo "<a href = 'index.php?p=recipe&cocktail=".$favorite."'>".$favorite."</a><br/>";
						}
					}
				}
			}
		}
	}

	// if user is not connected
	else {

		// tell him he isn't connected
		echo "<h2>Vous n'êtes pas connecté. Vos favoris ne seront pas enregistrés après votre déconnexion.</h2><br/>";

		// if user does have favorites
		if (isset($_COOKIE["user_favorites"])) {

			// if those aren't blank
			if ($_COOKIE["user_favorites"] != "") {

				// store them in a list
				$favorites_list = $_COOKIE["user_favorites"];

				if (preg_match("/|/", $favorites_list)) {

					$coktail = explode("|", $favorites_list);

					foreach ($coktail as $favorite) {

						if ($favorite != "") {
							echo "<a href = 'index.php?p=recipe&cocktail=".$favorite."'>".$favorite."</a><br/>";
						}
					}
				}
			}
		}

		// if user hasn't yet defined favorites
		else {
			// inform him about it
			echo "Vous n'avez encore aucun favori!";
		}
	}
?>
