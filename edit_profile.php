<?php
	// Importing user data
	include("include/users/".$_COOKIE["connected_user"].".php");

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
	$favorites = $user["favorites"];
?>

<!-- Displaying the different fields -->
<form method="post" action="#">

Mot de passe&nbsp;:&nbsp;<input type="text" name="password" placeholder="<?php echo $password; ?>"><br/>
Nom&nbsp;:&nbsp;<input type="text" name="surname" placeholder="<?php echo $surname; ?>"><br/>
Prénom&nbsp;:&nbsp;<input type="text" name="firstname" placeholder="<?php echo $firstname; ?>"><br/>
Anniversaire&nbsp;:<input type="text" name="birthday" placeholder="<?php echo $birthday; ?>"><br/>
Adresse e-mail&nbsp;:<input type="text" name="email" placeholder="<?php echo $email; ?>"><br/>
Téléphone&nbsp;:<input type="text" name="phone" placeholder="<?php echo $phone; ?>"><br/>
Adresse&nbsp;:<input type="text" name="address" placeholder="<?php echo $address; ?>"><br/>
CP&nbsp;:&nbsp;<input type="text" name="postalcode" placeholder="<?php echo $postalcode; ?>"><br/>
Ville&nbsp;:<input type="text" name="city" placeholder="<?php echo $city; ?>"><br/>

<input type="submit" value="Valider les modifications">
</form>

<?php
if (!empty($_POST)) {

	/* If user has edited some of the fields, we take the new values
	   if not, we keep the values we already had */

	// Checking whether a new password has been defined
	if ($_POST["password"] != "" && isset($_POST["password"])) {
		$new_password = $_POST["password"];
	}

	// if not, we keep the old one
	else {
		$new_password = $password;
	}

	// Checking whether a new surname has been defined
	if ($_POST["surname"] != "" && isset($_POST["surname"])) {
		$new_name = $_POST["surname"];
	}

	// if not, we keep the old one
	else {
		$new_name = $surname;
	}

	// Checking whether a new first name has been defined
	if ($_POST["firstname"] != "" && isset($_POST["firstname"])) {
		$new_firstname = $_POST["firstname"];
	}

	// if not, we keep the old one
	else {
		$new_firstname = $firstname;
	}

	// Checking whether a new date of birth has been defined
	if ($_POST["birthday"] != "" && isset($_POST["birthday"])) {
		$new_birthday = $_POST["birthday"];
	}

	// if not, we keep the old one
	else{
		$new_birthday = $birthday;
	}


	// Checking whether a new e-mail address has been defined
	if ($_POST["email"] != "" && isset($_POST["email"])) {
		$new_email = $_POST["email"];
	}

	// if not, we keep the old one
	else {
		$new_email = $email;
	}

	// Checking whether a new phone number has been defined
	if ($_POST["phone"] != "" && isset($_POST["phone"])) {
		$new_phone = $_POST["phone"];
	}

	// if not, we keep the old one
	else {
		$new_phone = $phone;
	}

	// Checking whether a new address has been defined
	if ($_POST["address"] != "" && isset($_POST["address"])) {
		$new_address = $_POST["address"];
	}

	// if not, we keep the old one
	else {
		$new_address = $address;
	}


	// Checking whether a new ZIP code has been defined
	if ($_POST["postalcode"] != "" && isset($_POST["postalcode"])) {
		$new_postalcode = $_POST["postalcode"];
	}

	// if not, we keep the old one
	else {
		$new_postalcode = $postalcode;
	}

	// Checking whether a new city has been defined
	if ($_POST["city"] != "" && isset($_POST["city"])) {
		$new_city = $_POST["city"];
	}

	// if not, we keep the old one
	else {
		$new_city = $city;
	}

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

// Informing user about the changes
echo "Vos données ont été modifiées";
?>
