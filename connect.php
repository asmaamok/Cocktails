<form method="post" action="#" >
<table>
	<tr><td>Identifiant:</td>&nbsp;<td><input type="text" name="username"></td></tr>
	<tr><td>Mot de passe:</td>&nbsp;<td><input type="text" name="password"></td></tr>
</table>
<input type="submit" value="Valider">
</form>

<?php
// Initialising test values
$user_check = null;
$password_check = null;

if (!empty($_POST)) {

	// Making sure username exists and is not empty
	if(isset($_POST["username"]) && $_POST["username"] != "") {

		// If a file is found in the users directory
		if (file_exists("include/users/".$_POST["username"].".php")) {

			// Telling user that it worked
			echo "le fichier utilisateur existe!";
			$username = $_POST['username'];

			// setting value to true
			$user_check = true;
		}
	}

	// If username isn't set or is blank
	else {
		echo "Le fichier utilisateur n'existe pas:&nbsp;";
	}
	
	// Checking wether a password that isn't blank is given
	if (isset($_POST["password"]) && $_POST["password"]!= "") {

		// If we have an existing username
		if ($user_check == true) {

			// We grab its password
			include("include/users/".$_POST["username"].".php");
			print_r($user["password"]);

			// If passwords are matching
			if ($user["password"] == $_POST["password"]) {

				// Setting value to true
				$password = $_POST["password"];
				$password_check = true;
			}


		}
	}

	// If both username and password are valid
	if ($user_check == true && $password_check == true) {

		// Telling user that it worked
		echo "le compte existe!";
		echo $username;

		// Generating one hour cookie
		setcookie("connected_user", $username, time() + 3600);

	}

	else {
		echo "Identifiant ou mot de passe erronés";
	}
}

/* else {
	echo "Merci de bien remplir les champs!";
} */
?>
