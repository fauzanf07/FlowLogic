<?php
    include("../../db.php");
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');

    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql = "UPDATE tb_post AS a SET a.status = '$status', a.accepted_at='$date' WHERE a.id = '$id'";
    $result = mysqli_query($con,$sql);
    if($result){
        echo json_encode(array('statusCode' => 201));
    }else{
        echo json_encode(array('statusCode' => 202));
    }
?>