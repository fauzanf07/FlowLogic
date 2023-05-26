<?php
    include ("../../db.php");

	$idUser = $_POST['idUser'];
	$benar = $_POST['benar'];
    $salah = $_POST['salah'];
    $xp = $_POST['xp'];
    $points = $_POST['points'];
    $nilai = $_POST['nilai'];
    $grade = $_POST['grade'];
    $quiz = $_POST['quiz'];
    $xpUser = $_POST['xpUser'];
    $pointsUser = $_POST['pointsUser'];

	$sql = "INSERT INTO tb_quiz VALUES('','$idUser','$benar','$salah', '$xp', '$points', '$nilai', '$grade','$quiz')" ;
	$result = mysqli_query($con,$sql);

	if($result){
        $sql = "UPDATE tb_user SET  xp = '$xpUser', `point`='$pointsUser' WHERE id = '$idUser'";
        $result = mysqli_query($con,$sql);
        if($result){
            $sql = "SELECT a.*, b.name FROM tb_quiz as a LEFT JOIN tb_user as b on a.id_user= b.id ORDER BY a.xp DESC, a.points DESC";
            $res = mysqli_query($con, $sql);
            $emparray = array();
            while($row =mysqli_fetch_assoc($res))
            {
                $emparray[] = $row;
            }
            echo json_encode($emparray);
        }
	}else{
		echo json_encode(array("statusCode"=>201));
    }
?>