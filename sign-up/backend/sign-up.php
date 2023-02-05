<?php 

include("../../db.php");

$txtEmail = $_POST['email'];
$txtName = $_POST['name'];
$txtKelas = $_POST['kelas'];
$txtUsername = $_POST['username'];
$txtPassword = base64_encode($_POST['password']);


$userSql = "SELECT * FROM tb_user WHERE `username` = '$txtUsername' OR `email` = '$txtEmail'";

$rsUser = mysqli_query($con, $userSql);

if (mysqli_num_rows($rsUser) > 0) {
	echo json_encode(array("statusCode"=>202));
}else{
	$sql = "INSERT INTO `tb_user` (`id`, `email`, `username`, `name`, `password`,`kelas`,`photo_profile`) VALUES ('0', '$txtEmail', '$txtUsername', '$txtName', '$txtPassword','$txtKelas','../images/avatar.jpg')";
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