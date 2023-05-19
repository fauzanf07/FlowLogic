<?php
    include('../../db.php');

    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');

    $content = $_POST['content'];
    $username = $_POST['username'];

    $sql = "SELECT id FROM tb_user WHERE username='$username'";
    $result = mysqli_query($con, $sql);
	$r = mysqli_fetch_assoc($result);
    $id_user = $r['id'];

    $sql = "INSERT INTO tb_post VALUES('','$id_user','$content','0','','$date')";
    $result = mysqli_query($con, $sql);
    if($result){
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }
    
?>