<?php
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    $con = mysqli_connect('localhost', 'root', '','db_gamifikasi');
}else{
    $con = mysqli_connect('localhost', 'stuz3844_db_gamifikasi', 'uzan7821','stuz3844_db_gamifikasi');
}
    
?>