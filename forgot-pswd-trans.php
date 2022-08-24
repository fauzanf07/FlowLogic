<?php 
	$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

	$txtUsername = $_POST['username'];
	$txtNewPassword = $_POST['newPassword'];
	$txtReNewPassword = $_POST['reNewPassword'];

	$sql = "SELECT * FROM tb_user WHERE `username` = '$txtUsername' OR `email` = '$txtUsername' " ;
	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
		$newPass = base64_encode($txtNewPassword);
		$changeSql = "UPDATE tb_user SET `password` = '$newPass' WHERE `username` = '$txtUsername' OR `email` = '$txtUsername'";
		$rs = mysqli_query($con,$changeSql);
		if($rs){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>202));
		}
	  	
	}else{
		echo json_encode(array("statusCode"=>201));
	}

 ?>