<?php
    include('../../db.php');

    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $likeMode = $_POST['mode'];

    if($likeMode == 0){
        $sql = "INSERT INTO tb_like_post VALUES('','$userId','$postId')";
    }else{
        $sql = "DELETE FROM tb_like_post WHERE id_user= '$userId' AND id_post = '$postId'";
    }
    $result = mysqli_query($con, $sql);
    if($result){
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }
?>