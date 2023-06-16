<?php
    include("../../db.php");

    $levelUpCourse = [6,100,100];
    $username = $_POST['username'];
    $sql = "SELECT * FROM tb_user AS a LEFT JOIN tb_courses AS b ON a.id = b.id_user WHERE username='$username'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $currCourse = $_POST['currCourse'];
    $currLevel = $row['level'];

    $levelUp = 0;

    if($currCourse==$levelUpCourse[$currLevel-1]){
        $levelUp=1;
    }

    if($levelUp){
        $currLevel++;
        $sql = "UPDATE tb_user SET `level` = '$currLevel' WHERE username='$username'" ;
	    $result = mysqli_query($con,$sql);
        if($result){
            echo json_encode(array("statusCode"=>200, "levelUp"=>1,"level" => $currLevel));
        }else{
            echo json_encode(array("statusCode"=>201));
        }
    }else{
        echo json_encode(array("levelUp"=>0));
    }