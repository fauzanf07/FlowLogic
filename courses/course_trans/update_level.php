<?php
    include("../../db.php");

    $max_xp = [300,500,750,1050,1400];
    $username = $_POST['username'];
    $sql = "SELECT * FROM tb_user WHERE username='$username'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['level'];
    $point = $row['point'];

    $levelUp = 0;

    if($point >= $max_xp[$level-1]){
        $levelUp=1;
    }

    if($levelUp){
        $level++;
        $sql = "UPDATE tb_user SET `level` = '$level' WHERE username='$username'" ;
	    $result = mysqli_query($con,$sql);
        if($result){
            echo json_encode(array("statusCode"=>200, "levelUp"=>1,"level" => $level));
        }else{
            echo json_encode(array("statusCode"=>201));
        }
    }else{
        echo json_encode(array("levelUp"=>0));
    }