<?php
    include("../../db.php");

    $idUser = $_POST['idUser'];
    $challenge = $_POST['challenge'];
    $points = $_POST['points'];

    $sql = "SELECT a.*, b.name FROM tb_challenge_rewards AS a LEFT JOIN badges_name AS b ON a.challenge = b.challenge  WHERE a.challenge='$challenge'";
    $res1 = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res1);
    $xp = $row['xp'];
    $nameBadge = $row['name'];

    $desc1 = "Kamu telah menyelesaikan Challenge ". $challenge;
    $desc2 = "Kamu telah menyelesaikan Challenge ". $challenge;
    $desc3 = "Kamu mendapatkan lencana ".$nameBadge. " atas menyelesaikan Challenge ".$challenge;

    $sql = "INSERT INTO tb_history VALUES('','$idUser','2','$xp','$desc1');";
    $sql .= "INSERT INTO tb_history VALUES('','$idUser','4','$points','$desc2');" ;
    $sql .= "INSERT INTO tb_history VALUES('','$idUser','3','0','$desc3');" ;
	$result = mysqli_multi_query($con,$sql);
    if($result){
        echo json_encode(array("statusCode"=>200));
    }else{
        $error = mysqli_error($con);
        echo "Query failed with error: " . $error;
        echo json_encode(array("statusCode"=>201));
    }
?>