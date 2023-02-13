<?php
    include("../../db.php");

	$currCourse = $_POST['currCourse'];
	$username = $_POST['username'];

    $sql = "SELECT * FROM tb_course_rewards WHERE id_course='$currCourse'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
	$point = $row['point'];
    $xp = $row['xp'];

    $sql = "SELECT * FROM tb_user WHERE username='$username'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $point += $row['point'];
    $xp += $row['xp'];

    $sql = "UPDATE tb_user SET `point` = '$point', `xp` ='$xp' WHERE username='$username'" ;
	$result = mysqli_query($con,$sql);

	if($result){
		echo json_encode(array("statusCode"=>200));
	}else{
		echo json_encode(array("statusCode"=>201));
	}