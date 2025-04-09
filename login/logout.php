<?php
session_start(); 
$_SESSION = array(); 
session_destroy(); 
header('location:index.php');
if($_SESSION['username'] == null){ 
    echo '您無權限觀看此頁面!'; 
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';  
	exit(); 
}   
?>