<?php
    include ("../../db.php");

    date_default_timezone_set('Asia/Jakarta');

	$idUser = $_POST['idUser'];
	$code = mysqli_real_escape_string($con,$_POST['code']);
    $sk = $_POST['sk'];
    $xp = $_POST['xp'];
    $points = $_POST['points'];
    $submit_at = date('Y-m-d H:i:s');

	$sql = "INSERT INTO tb_challenge_code VALUES('','$idUser','$code','$sk','$submit_at')";
	$result = mysqli_query($con,$sql);

	if($result){
        $sql = "UPDATE tb_user SET xp = xp + " . $xp . ", `point` = `point` + " . $points . " WHERE id = '" . $idUser . "'";
        $result = mysqli_query($con,$sql);
        if($result){
            $sql = "SELECT a.*, b.name FROM tb_challenge_code as a LEFT JOIN tb_user as b on a.id_user= b.id WHERE a.sk='$sk' ORDER BY a.submit_at DESC";
            $res = mysqli_query($con, $sql);
            $emparray = array();
            while($row =mysqli_fetch_assoc($res))
            {
                $emparray[] = $row;
            }
            $sql = "SELECT * FROM tb_challenge_code WHERE id_user='$idUser'";
            $query = mysqli_query($con, $sql);
            $num = mysqli_num_rows($query);
            $finish = $num == 5? 1 : 0;

            echo json_encode(array("listUser"=> $emparray,"finish"=>$finish));
        }
	}else{
		echo json_encode(array("statusCode"=>201));
    }
?>