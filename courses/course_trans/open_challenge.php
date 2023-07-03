<?php
    include("../../db.php");
	$idUser = $_POST['idUser'];
	$chall = $_POST['chall'];
    $quiz = $_POST['quiz'];
    $game = $_POST['game'];
    $minXpChall = [300,400,600];
    $minXpQuiz = [200,200,400];
    $minXpGame = [100];
    if($chall!=0){
        $minXp = $minXpChall[$chall-1];
    }else if($quiz !=0){
        $minXp = $minXpQuiz[$quiz-1];
    }else{
        $minXp = $minXpGame[$game-1];
    }
    $sql = "SELECT * FROM tb_user WHERE id='$idUser'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $xp = $row['xp'];
    if($xp<$minXp){
        echo json_encode(array("statusCode"=>202));
    }else{
        $sql = "INSERT INTO tb_open_access VALUES('','$idUser','$chall','$quiz','$game')" ;
        $result = mysqli_query($con,$sql);

        if($result){
            $sql = "UPDATE tb_user SET `xp`=`xp`-$minXp WHERE id = '$idUser'" ;
            $result = mysqli_query($con,$sql);
            if($result){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
        }else{
            echo json_encode(array("statusCode"=>201));
        }
    }
?>