<?php 
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

	$currCourse = $_POST['currCourse'];
	$username = $_POST['username'];

	$getCourseName = "SELECT tb_courses.id_user, tb_courses.curr_course, tb_course_names.name FROM tb_course_names INNER JOIN tb_courses ON tb_courses.curr_course = tb_course_names.id WHERE `id_user` = (SELECT id FROM `tb_user` WHERE `username` = '$username')";
	$rs = mysqli_query($con,$getCourseName);
	$row= mysqli_fetch_assoc($rs);
	$courseName = $row['name'];
	if($rs){
		if($currCourse == 0){
			$sql = "UPDATE tb_courses SET `curr_course` = '1' WHERE `id_user` = (SELECT id FROM `tb_user` WHERE `username` = '$username')";
			$result = mysqli_query($con,$sql);
			if($result){
				$getFirstCourse = "SELECT name FROM tb_course_names WHERE id = '1'";
				$result = mysqli_query($con,$getFirstCourse);
				$row1= mysqli_fetch_assoc($result);
				session_start();
				$_SESSION['curr_course'] = 1;
				echo json_encode(array("course"=>$row1['name']));
			}else{
				echo json_encode(array("statusCode"=>201));
			}
		}else{
			echo json_encode(array("course"=>$courseName));
		}
	}else{
		echo json_encode(array("statusCode"=>201));
	}

	
?>