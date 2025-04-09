<!DOCTYPE html> <!--告訴瀏覽器為html檔案-->
<html>
    <head> <!--head會放網頁資訊-->
        <!--meta標籤-->	
        <meta charset="UTF-8"/> <!--meta網頁編碼，寫網頁的描述-->	
        <meta name="description" content="描述"/> <!--content搜尋時下面出現的description描述-->
        <meta name="author" content="作者是誰"/>
        <meta name="keyword" content="關鍵字有甚麼，ex.html、球球"/>
        <meta name="viewport" content="width=device-width，initial-scale=1.0"/> <!--viewport=視口，根據使用的裝置來決定畫面等比例調整顯示-->
		<!--<meta http-equiv="refresh" content="11">下方10指每隔10秒刷新一次頁面. -->
		<link rel="stylesheet" href="open.css"/> <!--最上面的header的css-->
		<link rel="stylesheet" href="body2.css"/> <!--中間body的css-->
		<link rel="stylesheet" href="bb.css"/> <!--閃爍的css-->
		<link rel="stylesheet" href="body3.css"/><!--下面body的css-->		
        <title>無標題文件</title> <!--title會放網頁標題-->
		<style>

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
    <body> <!--body會放真正的網頁內容-->
		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="http://210.240.202.101/ww/">主頁</a>
		  <a href="http://210.240.202.101/wwt/">Map 地圖</a>
		  <!--<a href="#">Clients</a>	-->	  
		  <a href="http://210.240.202.101/login/logout.php">Logout 登出</a>
		</div>
		<nav class="header">
		<div class="logo">關懷守護智慧聯網系統</div>
		<div class="time1"><script src="time.js"></script>
            <form id="form1" runat="server">  
              <font color="Aqua" size="5"><div id = "mytime"></div></font>
            </form>
        </div>
		</nav><hr/>
		<span style="font-size:30px;cursor:pointer;line-height:68px;" onclick="openNav()">&#9776; open</span>
		<br/>
		
					
		<script>
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
		</script>
    
		<body>
			<div class="content">	
				<p style="font-size:28px;font-weight:bold;">被照護者居家環境狀態</p>
				<div class="row">
					<div class="column" id="box-model1" >
					  <p style="font-size:24px;font-weight:bold;" >體溫</p>
					  	&nbsp;&nbsp;
						<div class="card">
						<div class="highlight2" style="color:#FF0000;"><?php
							date_default_timezone_set("Asia/Shanghai");
					  		$input_maxnum="37.5";	//最高體溫
							$input_minnum="34.5";  //最小體溫
							$input_time=date("Y-m-d H:i:s");

							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM temp";
							$result = $pdo->query('select * from temp order by time desc limit 1;');
							
							foreach($result as $row){
								$db_num=$row['t'];
								$db_time=$row['time'];
							}
							$start = strtotime($db_time);  //開始時間
							$end = strtotime($input_time); //结束時間

							$tt=floor(($end - $start)%86400/60); // /86400(1天)
							//echo $tt;							
							if($tt<1){ 						//相減小1天傳	
								if($db_num>=$input_maxnum || $db_num<=$input_minnum){
										echo $db_num."需要注意";
										/*require_once('C:/xampp/htdocs/xampp/sendmailer.php');
										echo ' <br>'; 
										echo '  Email 發送成功';*/										
								}else{
									echo " ";
								}
							}	
						?></div>
					  <h3><?php
							include("C:/xampp/htdocs/appin/connMySQL.php");
	
							$sql_query = "SELECT * FROM temp";
							$result = $pdo->query('select * from temp order by time desc limit 1;');
							
							foreach($result as $row) {
								echo "<p>";
								echo "體溫 : ";
								echo $row["t"], " 度 ";
								echo "日期 : ";
								echo $row["time"];
								echo "</p>";
							}																				
						?></h3>
						  <p style="font-size:15px;font-weight:bold;">發燒的定義為身體體溫 ≥ 38℃，介於 37.5 ℃與 38 ℃ 之間的體溫可能正常也可能是低度發燒，必須參考前後測量的體溫與其他症狀判斷是否有發燒現象。</p>
						  <a href="https://www.hpa.gov.tw/Pages/Detail.aspx?nodeid=1125&pid=1610">發燒的定義資料來源:國民健康署</a>
						</div>
						<p style="font-size:20px;font-weight:bold;" >紀錄</p><script src="trigger.js"></script>
						<!--<input id="myInput" value="Some text..">
						<button id="myBtn" onclick="javascript:alert('su3ijvi')">Button</button>	<!--搜尋視窗-->
						<iframe src="http://210.240.202.101/appin/MysqlRead-T.php" width="350" style="background-color:white;">
						  你的瀏覽器不支援 iframe
						</iframe>					  
					</div>

				  <div class="column" id="box-model1">
				  <p style="font-size:24px;font-weight:bold;" >一氧化碳CO濃度</p>
				  	&nbsp;&nbsp;
				  	<div class="card">
					<div class="highlight2" style="color:#FF0000;"><?php
							date_default_timezone_set("Asia/Shanghai");
					  		$input_num="100.00";
							$input_time=date("Y-m-d H:i:s");
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM co";
							$result = $pdo->query('select * from co order by time desc limit 1;');
							
							foreach($result as $row){
								$db_num=$row['o'];
								$db_time=$row['time'];
							}
							$start = strtotime($db_time);
							$end = strtotime($input_time);

							$tt=floor(($end - $start)%86400/60);
							//echo $tt;

							if($tt<2){ 						//相減小2分傳	
								if($db_num>=$input_num){
										echo $db_num."需要注意";
										/*require_once('C:/xampp/htdocs/xampp/sendmailer.php');
										echo ' <br>'; 
										echo '  Email 發送成功';*/
								}else{
									echo " ";
								}
							}	
						?></div>
					  <h3><?php
							include("C:/xampp/htdocs/appin/connMySQL.php");
	
							$sql_query = "SELECT * FROM co";
							$result = $pdo->query('select * from co order by time desc limit 1;');
							
							foreach($result as $row) {
								echo "<p>";
								echo "CO : ";
								echo $row["o"], " ppm ";
								echo "日期 : ";
								echo $row["time"];
								echo "</p>";
							}																				
						?></h3>
					  <p style="font-size:15px;font-weight:bold;">濃度含量對身體健康狀態的影響請查以下網址</p>
					  <a href="https://www.mlfd.gov.tw/goods/dg02.aspx?inf=4">資料來源:苗栗縣消防局</a>
					</div>
					<p style="font-size:20px;font-weight:bold;" >紀錄</p>
					<iframe src="http://210.240.202.101/appin/MysqlRead-CO.php" width="350" style="background-color:white;">
						你的瀏覽器不支援 iframe
					</iframe>			
				  </div>
				  
				  <div class="column" id="box-model1">
				  <p style="font-size:24px;font-weight:bold;" >跌倒狀態紀錄</p>
				  	&nbsp;&nbsp;
				  	<div class="card">					
					<div class="highlight2" style="color:#FF0000;"><?php
							date_default_timezone_set("Asia/Shanghai");
					  		$input_name="跌倒了!";
							$input_time=date("Y-m-d H:i:s");							
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM fall";
							$result = $pdo->query('select * from fall order by time desc limit 1;');
							
							foreach($result as $row){
								$db_name=$row['g'];
								$db_time=$row['time'];
							}
							$start = strtotime($db_time);
							$end = strtotime($input_time);

							$tt=floor(($end - $start)%86400/60);
							//echo $tt;

							if($tt<1){						//相減小於2分傳
								if($input_name==$db_name){
										echo $db_name."需要注意";
										/*require_once('C:/xampp/htdocs/xampp/sendmailer.php');
										echo ' <br>'; 
										echo '  Email 發送成功';*/
								}else{
									echo " ";
								}	
							}
						?>
						</div>
					  <h3><?php
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM fall";
							$result = $pdo->query('select * from fall order by time desc limit 1;');
							
							foreach($result as $row) {
								echo "<p>";
								echo "我";
								echo $row["g"], " ";
								echo "日期 : ";
								echo $row["time"];
								echo "</p>";
							}													
						?></h3>
					</div>
					<p style="font-size:20px;font-weight:bold;" >紀錄</p>
					<iframe src="http://210.240.202.101/appin/MysqlRead-F.php" width="350" style="background-color:white;">
						你的瀏覽器不支援 iframe
					</iframe>	
				  </div>
				  <!---->
				  <div class="column" id="box-model1">
				  <p style="font-size:24px;font-weight:bold;" >求救情形紀錄</p>
				    &nbsp;&nbsp;
				 	<div class="card">
					<div class="highlight2" style="color:#FF0000;"><?php
							date_default_timezone_set("Asia/Shanghai");
					  		$input_name="求救";
							$input_time=date("Y-m-d H:i:s");
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM help";
							$result = $pdo->query('select * from help order by time desc limit 1;');
							
							foreach($result as $row){
								$db_name=$row['h'];
								$db_time=$row['time'];
							}
							$start = strtotime($db_time);
							$end = strtotime($input_time);

							$tt=floor(($end - $start)%86400/60);
							//echo $tt;

							if($tt<1){						//相減小於1分傳
								if($input_name==$db_name){
										echo $db_name."需要注意";
										require_once('C:/xampp/htdocs/xampp/sendmailer.php');
										echo ' <br>'; 
										echo '  Email 發送成功';
								}else{
									echo " ";
								}
							}	
						?></div>
					  <h3><?php
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM help";
							$result = $pdo->query('select * from help order by time desc limit 1;');
							
							foreach($result as $row) {
								echo "<p>";
								echo "我需要 ";
								echo $row["h"], " ";
								echo "日期 : ";
								echo $row["time"];
								echo "</p>";
							}													
						?></h3>
					</div>
					<p style="font-size:20px;font-weight:bold;" >紀錄</p>
					<iframe src="http://210.240.202.101/appin/MysqlRead-H.php" width="350" style="background-color:white;">
						你的瀏覽器不支援 iframe
					</iframe>	
				  </div>
				  <div class="column" id="box-model1">
				  <p style="font-size:24px;font-weight:bold;" >距離是否過遠</p>
				  	&nbsp;&nbsp;
				 	<div class="card">
						<div class="highlight2" style="color:#FF0000;"><?php
					  		date_default_timezone_set("Asia/Shanghai");
					  		$input_name="距離過遠";
							$input_time=date("Y-m-d H:i:s");
							
							//echo date("Y-m-d h:i:s");
							//echo $input_time;
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM cut";
							$result = $pdo->query('select * from cut order by time desc limit 1;');
							
							foreach($result as $row){
								$db_name=$row['d'];
								$db_time=$row['time'];
							}
							$start = strtotime($db_time);
							$end = strtotime($input_time);

							$tt=floor(($end - $start)%86400/60);  //相減時間差
							//echo $tt;

							if($tt<1){			//小於1分鐘傳

								if($input_name==$db_name){
										echo $db_name."需要注意";
										/*require_once('C:/xampp/htdocs/xampp/sendmailer.php');
										echo ' <br>'; 
										echo '  Email 發送成功';*/
								}else{
									echo " ";
								}
							}	
						?></div>
					  <h3><?php
							include("C:/xampp/htdocs/appin/connMySQL.php");
							
							$sql_query = "SELECT * FROM cut";
							$result = $pdo->query('select * from cut order by time desc limit 1;');
							
							foreach($result as $row) {
								echo "<p>";
								echo $row["d"], " ";
								echo "日期 : ";
								echo $row["time"];
								echo "</p>";
							}
							
						?></h3>
					  <p>可在地圖觀看到被照護者位置 請開啟open</p>					  
					</div>
					<p style="font-size:20px;font-weight:bold;" >紀錄</p>
					<iframe src="http://210.240.202.101/appin/MysqlRead-C.php" width="350" style="background-color:white;">
						你的瀏覽器不支援 iframe
					</iframe>	
				  </div>
				</div>
			</div>							
		</body>
		<div class="footer">			
			<!--專題團隊&nbsp;&nbsp;
			學校: 南華大學&nbsp;&nbsp;			
			指導教授: 柳茂林 教授&nbsp;&nbsp;
			團員: 陳維琦 羅瑾暄 沈妤蓉&nbsp;&nbsp;-->
		</div>	
	</body>
</html>