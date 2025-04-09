<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width，initial-scale=1.0"/> <!--viewport=視口，根據使用的裝置來決定畫面等比例調整顯示-->
    <title>地圖</title>
    <style type="text/css" media="screen">
    html {
        height: 100%;
        width: 100%;
    }
    body { 
    background-image:url(background.jpg); 
    background-size:cover;
    }
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
    #map {
        position: absolute;
        height: 75%;
        width: 800px;
        
    }
    #map1 {
        position: absolute;
        height: 75%;
        width: 800px;
        left: 25%;
    }
    .content{
            height: 550px;
            text-align: center;
            /*color:purple;*/
            margin-bottom: 15px;
            padding: 50px;
            font-size:32px;
        }
    #body1{
        height: 100%;
        width: 100vw;
        position: relative;
        top: 0;
        left: 0;
        
    }
    </style>
    <?php
		session_start();

		//如果沒有登入Session值 或是 Session值為空
		if(!isset($_SESSION["username"]) || ($_SESSION["username"]=="")){

		//前往登入頁面

		header("Location:/login/index.php");
		exit;	
		}/*else{
		//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
		header("Location: index.html"); }
		}*/
	?>
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

    <div class="body1">
        <h1 style="font-size:36px;">位置地圖</h1>
        <input type ="button" onclick="javascript:location.href='http://210.240.202.101/ww/'" value="回到首頁"></input>  
    </div>
    <div class="content">       
        <p style="font-size:24px;font-weight:bold;" >被照護者當前位置</p>       
        <iframe src="http://210.240.202.101/wwt/map1.php" width="750" height="550">
        </iframe>
        </br> 
        <p style="font-size:24px;font-weight:bold;" >被照護者位置經緯度、時間，每幾秒更新一次位置</p>
        <iframe src="http://210.240.202.101/appin/MysqlRead.php" width="400" style="background-color:white;">
                你的瀏覽器不支援 iframe
        </iframe>   
        <br/>
        <!--<p style="font-size:24px;font-weight:bold;" >被照護者路徑</p>          
        <iframe src="http://210.240.202.101/wwt/map2.php" width="750" height="550">
        </iframe>-->
    </div>   
</body>

</html>

