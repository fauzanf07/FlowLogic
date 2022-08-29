<?php 
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

	$currCourse = $_POST['currCourse'];
	$username = $_POST['username'];

	if($currCourse == 0){
		$sql = "UPDATE tb_courses SET `curr_course` = '1' WHERE `id_user` = (SELECT id FROM `tb_user` WHERE `username` = '$username')";
		$result = mysqli_query($con,$sql);
		if($result){
			echo json_encode(array("course"=>"course1"));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}else{
		echo json_encode(array("course"=>"course1"));
	}

?>