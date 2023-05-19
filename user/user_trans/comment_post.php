<?php
    include('../../db.php');

    $userId = $_POST['userId'];
    $postId = $_POST['postId'];
    $comment = $_POST['comment'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tb_comment_post VALUES('','$userId','$postId','$comment', '$date')";

    $result = mysqli_query($con, $sql);
    if($result){
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }
?>