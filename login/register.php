<?php   /*處理註冊 */
$conn=require_once("config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $password_check=$_POST["password_check"];
    $account = $_POST['mail'];
    $member = $_POST['name'];
    $phone1 = $_POST['phone1'];
    $phone2 = $_POST['phone2'];
    //檢查帳號是否重複
    $check="SELECT * FROM user WHERE username='".$username."'";
    if(mysqli_num_rows(mysqli_query($conn,$check))==0){
        $sql="INSERT INTO user (id,username, password,mail,name,phone1,phone2)
            VALUES(NULL,'".$username."','".$password."','".$password_check."','".$account."','".$member."','".$phone1."','".$phone2."')";
        if ( strlen($username) < 6 || strlen($username) > 11 ) {
            echo"<script>alert('登入帳號字元限制 6~10 個字元');history.go(-1);</script>";
            die;
        }
        if ( $password != $password_check ) {
            echo"<script>alert('兩次密碼輸入不相同');history.go(-1);</script>";
            die;
        }
        if ( strlen($phone1) > 11 || strlen($phone2) > 11) {
            echo"<script>alert('手機號碼字元限制 10 個字數');history.go(-1);</script>";
            die;
        }
        if(mysqli_query($conn, $sql)){
            echo "註冊成功!3秒後將自動跳轉頁面<br>";
            echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            header("refresh:32;url=index.php");
            exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='register.html'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        //header("refresh:3;url=register.html",true);
        exit;
    }
}


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
} 
?>