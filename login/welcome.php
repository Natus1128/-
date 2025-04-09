<?php   /*登入成功後出現的頁面(裡面包含一個登出的連結)*/
session_start();  //很重要，可以用的變數存在session裡
//如果沒有登入Session值 或是 Session值為空
//if(!isset($_SESSION["username"]) || ($_SESSION["username"]=="")){
    //前往登入頁面   
    //header("Location: index.php");    
//}else{ 
    //若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
    //header("Location: /ww/index.php"); 
//}

$username=$_SESSION["username"];
echo "<h1>確認登出嗎? ".$username."</h1>";
echo "<a href='logout.php'>登出</a>";
?>