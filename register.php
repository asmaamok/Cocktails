<form method="post" action="#" >

<!-- Displaying the different sections of registeration -->
<table>
	<!-- username field -->
	<tr>
		<td>Nom&nbsp;d'utilisateur&nbsp;:</td> 
		<td><input type="text" name="username" pattern="[A-Za-z0-9]" title="Can't contain spécial caractere
		"></td>
	</tr>

	<!-- password field -->
	<tr>
  		<td>Mot&nbsp;de&nbsp;passe&nbsp;:</td> 
  		<td><input type="text" name="password"></td> 
	</tr>

	<!-- surname field -->
	<tr>
  		<td>Nom&nbsp;de&nbsp;famille&nbsp;:</td>
  		<td><input type="text" name="surname" pattern="[A-Za-z]" title="Must contain only letters"></td> 
	</tr>

	<!-- first name field -->
	<tr>
  		<td>Prénom&nbsp;:</td>
  		<td><input type="text" name="firstname" pattern="[A-Za-z]" title="Must contain only letters"></td> 
	</tr>

	<!-- gender field -->
	<tr>
		<td>Sexe :</td> 
		<td><input type="radio" id="gender" name="gender" value="male">&nbsp;H
		<input type="radio" id="gender" name="gender" value="female">&nbsp;F</td> 
	</tr>

	<!-- birthdate field -->
	<tr>
  		<td>Date&nbsp;de&nbsp;naissance&nbsp;(avant&nbsp;2000)&nbsp;:</td>
		<td><input type="date" name="birthday" max="2000-01-01"></td> 
	</tr>

	<!-- e-mail field -->
	<tr>
  		<td>Adresse&nbsp;e-mail&nbsp;:</td> 
  		<td><input type="email" name="email"></td> 
	</tr>

	<!-- phone number field -->
	<tr>
  		<td>Numéro&nbsp;de&nbsp;téléphone&nbsp;:</td> 
  		<td><input type="tel" name="phone" pattern="[0-9]{10}" title="Only frensch phone nummer"></td> 
	</tr>

	<!-- address field -->
	<tr>
  		<td>Adresse&nbsp;:</td>
  		<td><input type="text" name="address" ></td>
	</tr>

	<!-- ZIP code field -->
	<tr>
		<td>CP&nbsp;:</td> 
  		<td><input type="number" name="postalcode" pattern="[0-9]{5}" title="Three letter country code"></td>
	</tr>

	<!-- city field -->
	<tr>
		<td>Ville&nbsp;:</td> 
  		<td><input type="text" name="city" pattern="[A-Za-z]" title="Must contain only letters"></td>
	</tr>
</table>

<input type="submit" value="Valider">
</form>

<?php
	// Checking whether the $_POST array is empty
	if (!empty($_POST)) {

		// Checking whether we do have a non-blank username
		if (isset($_POST["username"]) && $_POST["username"]!= "") {

			// Preparing the path to the file that will store the credentials
			$file = "include/users/".$_POST["username"].".php";

			// Checking whether that username already is taken
			if (!file_exists($file)) {

				// If not, we create it
				$username = $_POST["username"];

				// checking whether the password is acceptable
				if (isset($_POST["password"]) && $_POST["password"]!= "") {
					$password = $_POST["password"];
				}

				// checking whether the surname is acceptable
				if (isset($_POST["surname"]) && $_POST["surname"]!= "") {
					$surname = $_POST["surname"];
				}

				// checking whether the first name is acceptable
				if (isset($_POST["firstname"]) && $_POST["firstname"]!= "") {
					$firstname = $_POST["firstname"];
				}

				// checking whether the gender is acceptable
				if (isset($_POST["gender"]) && $_POST["gender"]!= "") {
					$gender = $_POST["gender"];
				}

				// checking whether the birthdate is acceptable
				if (isset($_POST["birthday"]) && $_POST["birthday"]!= "") {
					$birthday = $_POST["birthday"];
				}

				// checking whether the e-mail address is acceptable
				if (isset($_POST["email"]) && $_POST["email"]!= "") {
					$email = $_POST["email"];
				}

				// checking whether the phone number is acceptable
				if (isset($_POST["phone"]) && $_POST["phone"]!= "") {
					$phone = $_POST["phone"];
				}

				// checking whether the address is acceptable
				if (isset($_POST["address"]) && $_POST["address"]!= "") {
					$address = $_POST["address"];
				}

				// checking whether the ZIP code is acceptable
				if (isset($_POST["postalcode"]) && $_POST["postalcode"]!= "") {
					$postalcode = $_POST["postalcode"];
				}

				// checking whether the city is acceptable
				if (isset($_POST["city"]) && $_POST["city"]!= "") {
					$city = $_POST["city"];
				}

				/* $user = array(
					'username' => $username, 
					'password' => $password, 
					'surname' => $surname, 
					'firstname' => $firstname, 
					'gender' => $gender, 
					'birthday' => $birthday, 
					'email' => $email, 
					'phone' => $phone, 
					'address' => $address, 
					'postalcode' => $postalcode, 
					'city' => $city, 
					'favorites' => '', 
				);

				print_r($user); */

				$filename = "include/users/".$_POST["username"].".php";
				echo $filename;

				// if the file doesn't exist, it is automatically created
				$file = fopen($filename, "x+");
	
				fputs($file, "<?php\n");
				fputs($file, "\$user"."= array( \n");
				fputs($file, "'username' => '".$username."',\n");
				fputs($file, "'password' => '".$password."',\n");
				fputs($file, "'surname' => '".$surname."',\n");
				fputs($file, "'firstname' => '".$firstname."',\n");
				fputs($file, "'gender' => '".$gender."',\n");
				fputs($file, "'birthday' => '".$birthday."',\n");
				fputs($file, "'email' => '".$email."',\n");
				fputs($file, "'phone' =>'".$phone."',\n");
				fputs($file, "'address' => '".$address."',\n");
				fputs($file, "'postalcode' => '".$postalcode."',\n");
				fputs($file, "'city' => '".$city."',\n");
				fputs($file, "'favorites' => ''\n");
				fputs($file, ");\n?>");
				// fputs($file, var_export($user));

				echo "<br/>Fichier créé avec succès!";

			}

			else {
				echo "Ce nom d'utilisateur est déjà attribué!";
			}
		}
	}
?>
