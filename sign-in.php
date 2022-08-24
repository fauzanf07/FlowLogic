<?php 
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

	$txtUsername = $_POST['signUsername'];
	$txtPassword = $_POST['signPassword'];

	$sql = "SELECT * FROM tb_user WHERE `username` = '$txtUsername' OR `email` = '$txtUsername' " ;
	$result = mysqli_query($con,$sql);
	$pass = "";
	$admin = 0;

	if (mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_array($result)) {
	  	$pass = base64_decode($row["password"]);
	  	$admin = $row["admin"];
	  	session_start();
	  	$_SESSION['name'] = $row["name"];
	  	$_SESSION['username'] = $row["username"];
	  	$_SESSION['photo_profile'] = $row["photo_profile"];
	  }
	  if($txtPassword == $pass){
	  	if($admin == 1){
	  		echo json_encode(array("statusCode"=>200));
	  	}else{
	  		echo json_encode(array("statusCode"=>201));
	  	}
	  	
	  }
	  else{
	  	echo json_encode(array("statusCode"=>202));
	  }
	}else{
		echo json_encode(array("statusCode"=>202));
	}

?>