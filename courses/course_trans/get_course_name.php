<?php 
	include("../../db.php");

	$course = $_POST['course'];

	$sql = "SELECT * FROM tb_course_names WHERE id = '$course'" ;
	$result = mysqli_query($con,$sql);

	if($result){
		$row = mysqli_fetch_assoc($result);
		$courseName = $row['name'];

		echo json_encode(array("courseName"=>$courseName));
	}else{
		echo json_encode(array("statusCode"=>201));
	}
 ?>