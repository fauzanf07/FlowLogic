<?php
    include("../../db.php");

    $idUser = $_POST['idUser'];
    $jmlPoin = $_POST['jmlPoin'];
    $desc = $_POST['desc'];

    $sql = "UPDATE tb_user AS a SET a.point= a.point+$jmlPoin WHERE a.id = '$idUser'";
    $result = mysqli_query($con,$sql);
    if($result){
        $sql = "INSERT INTO tb_history VALUES('','$idUser','4','$jmlPoin','$desc')";
        $reslt = mysqli_query($con,$sql);
        if($reslt){
            echo json_encode(array('statusCode' => 200));
        }else{
            echo json_encode(array('statusCode' => 202));
        }
        
    }else{
        echo json_encode(array('statusCode' => 203));
    }
?>