<?php 
	session_start();
	unset($_SESSION["name"]);
	unset($_SESSION["username"]);
	unset($_SESSION["photo_profile"]);
	header("Location: http://localhost/skripsi/");
 ?>