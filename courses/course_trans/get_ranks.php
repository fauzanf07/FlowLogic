<?php
    include("../../db.php");

	$offset = $_POST['offset'];
	$rankPage = $_POST['rankPage'];

	$sql = "SELECT * FROM tb_user WHERE admin='0'" ;
	$res = mysqli_query($con,$sql);
	$count = mysqli_num_rows($res);
	$maxPage = ceil($count/5);
	$sql = "SELECT * FROM tb_user WHERE admin='0' ORDER BY point DESC, xp DESC LIMIT $offset,5" ;

	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
		$emparray = array();
	 	while($row =mysqli_fetch_assoc($result))
	    {
	        $emparray[] = $row;
	    }
		if($rankPage == $maxPage){
			echo json_encode(array("max"=>1,"arr"=>$emparray));
		}else{
			echo json_encode(array("max"=>0,"arr"=>$emparray));
		}
	}else{
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($con);
?>