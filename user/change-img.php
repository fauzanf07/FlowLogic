<?php 
   $con = mysqli_connect('localhost', 'root', '','db_gamifikasi');

   session_start();

   $username = $_SESSION['username'];

   if(isset($_FILES['file']['name'])){

      $filename = $_FILES['file']['name'];

      $location = "../images/usr-img/".$filename;
      $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);

      $valid_extensions = array("jpg","jpeg","png");

      $response = 0;
      if(in_array(strtolower($imageFileType), $valid_extensions)) {
         if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $changeSql = "UPDATE tb_user SET `photo_profile` = '$location' WHERE `username` = '$username'";
            $rs = mysqli_query($con,$changeSql);
            if($rs){
               $_SESSION['photo_profile'] = $location;
               echo json_encode(array("statusCode"=>200));
            }else{
               echo json_encode(array("statusCode"=>201));
            }

         }else{
            echo "Not uploaded because of error #".$_FILES["file"]["error"];
            echo json_encode(array("statusCode"=>202));
         }
         
      }else{
            echo json_encode(array("statusCode"=>203));
      }
   }
   else{
      echo json_encode(array("statusCode"=>204));
   }
   
 ?>