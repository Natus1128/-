<?php /*預設的首頁(登入頁面)*/
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /ww/index.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登入介面</title>
<style>
    .header {
        padding: 60px;
        text-align: center;
        background: #1abc9c;
        color: white;
        font-size: 30px;
    }
    .logo {
        font-size: 30px;
        font-weight: 700;
        line-height: 46px;
        position:absolute;
        left :120px;
        top:40px;
    }
    .container {
        padding: 16px;
        text-align: center;

    }
    #box-model1{ 
          border-width: 5px;
          border-style: solid;
          border-color: gray;
          width: 580px; 
          height: 450px;
          margin: 20px auto 20px auto;   
      }
      .input-field {
        width: 70%;
        padding: 10px;
        outline: none;
        font-size: 30px;
        border-width: 1px;
     }
    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
        border-radius: 8px;
    }

    /* Add a hover effect for buttons */
    button:hover {
        opacity: 0.8;
    }
    .time1{
        line-height: 46px;
        position:absolute;
        right:50px;
        top:40px;
    }
</style>
</head>
<body>    
    <nav class="header">
        <div class="logo">關懷守護智慧聯網系統
            <!--<h1 ></h1>-->
        </div>
        <div class="time1"><script src="time.js"></script>
            <form id="form1" runat="server">  
              <font color="Aqua" size="5"><div id = "mytime"></div></font>
            </form>
        </div>
    </nav>
    <hr/>
    <div class="container">
        <div id="box-model1" >
            <form style="font-size:24px;font-weight:bold;" method="post" action="login.php">
            <p style="font-size:28px;font-weight:bold;" >登入系統</p>
            帳號：
            <input class="input-field" type="text" name="username"><br/><br/>
            密碼：
            <input class="input-field" type="password" name="password"><br><br>
            <button type="submit">登入</button>&nbsp;&nbsp;
            <label>
                <input type="checkbox" checked="checked" name="remember">記住我
            <label><br><br>
            <a href="register.html">註冊帳號</a>
            </form>
        </div>
    </div>
</body>
</html>
