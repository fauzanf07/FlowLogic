<?php 
	include("../../db.php");

	$id = $_POST['id'];

	$sql = "SELECT * FROM tb_user WHERE id = '$id'";
	$rs = mysqli_query($con,$sql);
	$changeSql = "";
	if (mysqli_num_rows($rs) > 0) {
	  while($row = mysqli_fetch_array($rs)) {
	  	$admin = $row["admin"];
	  }
	  if($admin == 1){
	  	$changeSql = "UPDATE tb_user SET `admin` = 0 WHERE id = '$id'";
	  	
	  }else{
	  	$changeSql = "UPDATE tb_user SET `admin` = 1 WHERE id = '$id'";
	  }
	  $result = mysqli_query($con,$changeSql);
	  if($result){
	  	echo json_encode(array("statusCode"=>200));
	  }else{
	  	echo json_encode(array("statusCode"=>201));
	  }
	}

 ?>