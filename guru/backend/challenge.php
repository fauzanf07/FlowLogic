<?php
    include("../../db.php");
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');

    $idPost = $_POST['id'];
    $idUser = $_POST['idUser'];
    $challenge = $_POST['idChall'];
    $status = $_POST['idStatus'];
    $nilai = $_POST['nilai'];
    $points = $_POST['points'];

    $sql = "UPDATE tb_post AS a SET a.status = '$status', a.grade = '$nilai', a.accepted_at='$date' WHERE a.id = '$idPost'";
    $res = mysqli_query($con,$sql);

    if($res){
        if($status == 1){
            $sql = "INSERT INTO tb_users_badge VALUES('','$idUser','$challenge','$date')" ;
            $result = mysqli_query($con,$sql);
            if($result){
                $sql = "SELECT * FROM tb_challenge_rewards WHERE challenge='$challenge'";
                $res1 = mysqli_query($con,$sql);
                $row = mysqli_fetch_assoc($res1);
                $xp = $row['xp'];
                
                $sql = "UPDATE tb_user AS a SET a.badges= a.badges+1, a.xp = (a.xp + $xp), a.point = (a.point + $points) WHERE a.id = '$idUser'";
                $reslt = mysqli_query($con,$sql);
                if($reslt){
                    echo json_encode(array('statusCode' => 201));
                }else{
                    echo json_encode(array('statusCode' => 202));
                }
            }
        }else{
            echo json_encode(array('statusCode' => 201));
        }
    }else{
        echo json_encode(array('statusCode' => 202));
    }
?>