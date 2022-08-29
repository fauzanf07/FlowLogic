<?php 
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

	$sql = "SELECT tb_courses.id, tb_user.name, tb_user.photo_profile, tb_courses.curr_course, COUNT(*) as total_user FROM `tb_courses` INNER JOIN tb_user ON tb_user.id = tb_courses.id_user GROUP BY tb_courses.curr_course" ;
	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
		$emparray = array();
	 	while($row =mysqli_fetch_assoc($result))
	    {
	        $emparray[] = $row;
	    }
	    echo json_encode($emparray);
	}else{
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($con);
 ?>