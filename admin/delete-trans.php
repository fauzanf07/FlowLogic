<?php 
	include("../../db.php");

	$id = $_POST['id'];

	$sql = "DELETE FROM tb_user WHERE id = '$id'";
	$rs = mysqli_query($con,$sql);
	if($rs){
	  	echo json_encode(array("statusCode"=>200));
	}else{
	  	echo json_encode(array("statusCode"=>201));
	}

 ?>