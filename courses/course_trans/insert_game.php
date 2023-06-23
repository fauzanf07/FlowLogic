<?php
    include ("../../db.php");

	$idUser = $_POST['idUser'];
    $points = $_POST['points'];
    $game = $_POST['game'];

	$sql = "INSERT INTO tb_game VALUES('','$idUser','$points', '$game')" ;
	$result = mysqli_query($con,$sql);

	if($result){
        $sql = "UPDATE tb_user SET `point`=`point`+$points WHERE id = '$idUser'";
        $result = mysqli_query($con,$sql);
        if($result){
            echo json_encode(array("statusCode"=>200));
        }
	}else{
		echo json_encode(array("statusCode"=>201));
    }
?>