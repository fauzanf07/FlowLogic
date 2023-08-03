<?php 
	session_start();
	unset($_SESSION["name"]);
	include('../server.php');
	header("Location: ".$mainUrl);
 ?>