<?php 
	include("../../db.php");

	$currCourse = $_POST['currCourse']+1;
	$username = $_POST['username'];

	$sql = "UPDATE tb_courses SET curr_course = '$currCourse' WHERE id_user = (SELECT id FROM tb_user WHERE username = '$username')" ;
	$result = mysqli_query($con,$sql);

	if($result){
		session_start();
		$_SESSION['curr_course'] = $currCourse;
		echo json_encode(array("statusCode"=>200));
	}else{
		echo json_encode(array("statusCode"=>201));
	}
?>