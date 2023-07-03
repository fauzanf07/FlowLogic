<?php
    include("../../db.php");
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');

    $idUser = $_POST['idUser'];
    $challenge = $_POST['idChall'];
    $sql = "INSERT INTO tb_users_badge VALUES('','$idUser','$challenge','$date')" ;
    $result = mysqli_query($con,$sql);
    if($result){
        $sql = "UPDATE tb_user AS a SET a.badges= a.badges+1 WHERE a.id = '$idUser'";
        $reslt = mysqli_query($con,$sql);
        if($reslt){
            echo json_encode(array('statusCode' => 201));
        }else{
            echo json_encode(array('statusCode' => 202));
        }
    }
?>