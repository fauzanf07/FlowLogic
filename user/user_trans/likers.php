<?php 
	include("../../db.php");

	$idPost = $_POST['idPost'];

	$sql = "CALL likes('$idPost') " ;

	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0) {
		$emparray = array();
	 	while($row =mysqli_fetch_assoc($result))
	    {
	        $emparray[] = $row;
	    }
	    echo json_encode($emparray);
	}else{
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($con);

?>