<?php 
	include("../../db.php");

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
	  	$id = $row['id'];
	  	$currCourseSql = "SELECT tb_courses.curr_course FROM `tb_courses` INNER JOIN tb_user ON tb_user.id = tb_courses.id_user WHERE tb_courses.id_user = '$id'";
	  	$resultCurr = mysqli_query($con,$currCourseSql);
	  	$resultCourse = mysqli_fetch_assoc($resultCurr);
	  	$currCourse = $resultCourse['curr_course'];
	  	session_start();
	  	$_SESSION['curr_course'] = $currCourse;
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