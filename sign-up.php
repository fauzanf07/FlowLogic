<?php 

$con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

$txtEmail = $_POST['email'];
$txtName = $_POST['name'];
$txtUsername = $_POST['username'];
$txtPassword = base64_encode($_POST['password']);


$userSql = "SELECT * FROM tb_user WHERE `username` = '$txtUsername' OR `email` = '$txtEmail'";

$rsUser = mysqli_query($con, $userSql);

if (mysqli_num_rows($rsUser) > 0) {
	echo json_encode(array("statusCode"=>202));
}else{
	$sql = "INSERT INTO `tb_user` (`id`, `email`, `username`, `name`, `password`,`photo_profile`) VALUES ('0', '$txtEmail', '$txtUsername', '$txtName', '$txtPassword','../images/avatar.jpg')";
	$rs = mysqli_query($con, $sql);

	if($rs)
	{
		$sql = "INSERT INTO `tb_courses` (`id`, `id_user`,`curr_course`) VALUES ('0', (SELECT id FROM `tb_user` WHERE `username` = '$txtUsername'),'0')";
		$rs = mysqli_query($con, $sql);
		if($rs){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
		
	}else{
		echo json_encode(array("statusCode"=>202));
	}
}
mysqli_close($con);
?>