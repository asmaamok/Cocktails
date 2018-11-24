<?php
	// Setting cookie value to nothing
	setcookie('connected_user');

	// Confirmation message
	echo "Vous vous êtes bien déconnecté";
	print_r($_COOKIE);
?>
