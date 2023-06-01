<?php
    include("../../db.php");

    $idUser = $_POST['idUser'];
    $type = $_POST['type'];
    $earns = $_POST['earns'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO tb_history VALUES('','$idUser','$type','$earns','$desc')" ;
	$result = mysqli_query($con,$sql);

    if($result){
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }
?>