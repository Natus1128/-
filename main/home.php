<!DOCTYPE html>
<html lang="en">

<head>
<title>居家守護</title>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Cottage">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link href="css/global.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="css/datepicker3.min.css" />
<link rel="stylesheet" href="css/style.css" />

<!-- 網頁並排 -->

<link href="css/Layout1.css" rel="stylesheet">

<link rel="stylesheet" href="css/default-style.css" id="layout" />
<link href="css/switcher.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" type="text/javascript">
        function ShowTime()
        {
            var NowDate = new Date();
            var d = NowDate.getDay();
            var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
            document.getElementById('showbox').innerHTML =   NowDate.toLocaleString() ;
            setTimeout('ShowTime()', 1000);
        }
    </script>
<body>

<!-- Breadcrumb start -->
<div class="breadcrumb">
	<div class="bg-banner breadcrumb-img-2">
		<div class="container">
			<div class="breadcrumb-box">
						
				<div class="page-title">
					<h2><font size= "100pt">居家守護</font></h2>
				</div>
				<ul class="hierarchy">
						<li><a href="http://210.240.202.122/dashboard/moban2421/home.php"><font size= "4pt">居家狀態</font></a></li>
						<li><a href="http://210.240.202.122/dashboard/moban2421/health.php"><font size= "4pt">健康資訊</font></a></li>
						<li><a href="http://210.240.202.122/dashboard/moban2421/location.php"><font size= "4pt">定位資訊</font></a></li>
					   <li>&nbsp;&nbsp;&nbsp;</li>
				</ul>
				<body onload="ShowTime()">
				<form align="right" id="form1" runat="server" color="#FFFFF2">
				<font color="#FFFFF2" ><div id = "showbox"></div></font>
					</form>
					</body>
			</div>
		</div>
	</div>
</div>


<body style="background-color:#FFDEFF;">
<div class="outsides"style="background-color:#FFDEFF;">
	<div id="lefts" style="background-color:#FFDEFF;">
	<table>
		<br>
		<tr bgcolor="#cccccc">
		<td width="90"><font size= "4pt">&nbsp;居家狀況</font></td>
		</tr>
		
	</table>
	</div>
	
	<div id="righth"style="background-color:#FFDEFF;">	
		<table>
		<br>
		<tr bgcolor="#cccccc">
		<td width="120"><font size= "4pt">&nbsp;一氧化碳濃度</font></td>
		</tr>
		
	</table>
	</div>
	
	<div id="leftS"><?php  //磁簧開關
	
		$time1="0000-00-00 00:00:00";
		$time2="0000-00-00 00:00:00";
		
		if(isset($_POST['SWstate'])){
			$value = $_POST['SWstate' ];

			file_put_contents("s5.txt",$value);
			$str = file_get_contents("s5.txt");
			echo $str;
		}
		else{
			$str = file_get_contents("s5.txt",FILE_USE_INCLUDE_PATH);
			
			$ostr=$str . '&';
			$fname = "a5.txt ";
			$aa  =  file_get_contents($fname);
			file_put_contents("a5.txt", $ostr . $aa);
			$ast = file_get_contents("a5.txt");	
			$aAr=explode("&", $ast);
			
			if($aAr[0]!= $aAr[1]){//如果量出的數值跟前一量測結果不一樣則進入
			
				
				$Ar=explode(",", $str);
					
				echo '<br>';
				
				if($Ar[2]=='1'){ //人在家
					date_default_timezone_set('Asia/Taipei');
					$timein2 = date('Y/m/d H:i:s');
					
					echo '&nbsp;&nbsp;開關門時間差：';
					echo  $Ar[0];
					echo '秒<br>';
					echo '&nbsp;&nbsp;關門到按鈕時間：';
					echo  $Ar[1];
					echo '秒<br>';
					echo '&nbsp;&nbsp;狀態:：&nbsp;&nbsp;&nbsp;人在室內';
					echo '<br>';
					echo '&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;';
					echo $timein2;
					echo ' <br>';
					
					//狀況儲存
					$tr='開關門時間差：'.$Ar[0].
						'秒<br>&nbsp;&nbsp;關門到按鈕時間：'.$Ar[1].
						'秒<br>&nbsp;&nbsp;狀態:：&nbsp;&nbsp;&nbsp;人在家
						<br>&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;'.$timein2.',';
					$fname = "x5.txt ";
					$xx  =  file_get_contents($fname);
					file_put_contents("x5.txt", $tr . $xx);
					$st = file_get_contents("x5.txt");
					
					$Arr=explode(",", $st);
					
					echo "<font style=\"font-size: 15pt\"><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>'; 
					
					
				}elseif($Ar[2]=='0'){ //人已離開
					date_default_timezone_set('Asia/Taipei');
					$timeout = date('Y/m/d H:i:s');
					
					echo '&nbsp;開關門時間差：';
					echo  $Ar[0];
					echo '秒<br>';
					
					echo '&nbsp;&nbsp;關門到確認離開的時間差：';
					echo  $Ar[1];
					echo '秒<br>';
					echo '&nbsp;&nbsp;狀態:：&nbsp;&nbsp;&nbsp;人已離開室內';
					echo '<br>';
					
					echo '&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;';
					echo $timeout;
					echo ' <br>';
					//發送EMAIL
					require_once('sendmailer.php');
					LeaveRoom();
					echo ' <br>'; 
					echo '  Email 發送成功';
					
					//狀況儲存
					$tr='開關門時間差：'.$Ar[0].
						'秒<br>&nbsp;&nbsp;關門到確認離開的時間差：'.$Ar[1].
						'秒<br>&nbsp;&nbsp;狀態:：&nbsp;&nbsp;&nbsp;人已離開家
						<br>&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;'.$timeout.',';
					$fname = "x5.txt ";
					$xx  =  file_get_contents($fname);
					file_put_contents("x5.txt", $tr . $xx);
					$st = file_get_contents("x5.txt");
					
					$Arr=explode(",", $st);
					
					echo "<font style=\"font-size: 15pt\"><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>'; 
					
						
				}elseif($Ar[2]=='b'){ //門忘了關&藍芽無回應
					date_default_timezone_set('Asia/Taipei');
					$time2 = date('Y/m/d H:i:s');
					$time1 = date('H:i:s');
					$time3 = date('H');
					
					$hour=floor((strtotime($time1)-($Ar[1]))%86400/3600+8);
					$minute=floor((strtotime($time1)-($Ar[1]))%86400%3600/60);
					$second=floor((strtotime($time1)-($Ar[1]))%86400%60);
					
					echo "&nbsp;&nbsp;開門時間：".$hour."時".$minute."分".$second."秒";
					echo '<br>&nbsp;&nbsp;狀態：&nbsp;&nbsp;門忘了關';
					echo '<br>當時時間：<br>&nbsp;&nbsp';
					echo $time2;
					//發送EMAIL
					require_once('sendmailer.php');
					DoorOp();
					echo ' <br>'; 
					echo '  Email 發送成功';
					
					//狀況儲存
					$tr='&nbsp;開門時間：'.$hour.'時'.$minute.'分'.$second.
						'秒<br>&nbsp;&nbsp;&nbsp;狀態：&nbsp;&nbsp;門忘了關<br>當時時間：<br>
						&nbsp;&nbsp'.$time2.',';
					$fname = "x5.txt ";
					$xx  =  file_get_contents($fname);
					file_put_contents("x5.txt", $tr . $xx);
					$st = file_get_contents("x5.txt");
					
					$Arr=explode(",", $st);
					
					echo "<font style=\"font-size: 15pt\"><br><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>'; 
						
						
				}elseif($Ar[2]=='Help'){ //收到緊急求救
					date_default_timezone_set('Asia/Taipei');
					$time2 = date('Y/m/d H:i:s');
					
					echo '&nbsp;&nbsp;收到緊急求救<br>';
					require_once('sendmailer.php');
					echo '&nbsp;&nbsp;收到時間：<br>&nbsp;&nbsp;';
					echo $time2;
					echo ' <br>'; 
					//發送EMAIL
					require_once('sendmailer.php');
					IndoorHelp();
					echo ' <br>'; 
					echo '  Email 發送成功';
					
					//狀況儲存
					$tr='收到緊急求救<br>&nbsp;&nbsp;收到時間：<br>&nbsp;&nbsp;'
						.$time2.'<br>Email 發送成功,';
					$fname = "x5.txt ";
					$xx  =  file_get_contents($fname);
					file_put_contents("x5.txt", $tr . $xx);
					$st = file_get_contents("x5.txt");
					
					$Arr=explode(",", $st);
					echo "<font style=\"font-size: 15pt\"><br><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>';
					
						
				}elseif($Ar[2]=='Disconnect'){ //藍芽未連接
					date_default_timezone_set('Asia/Taipei');
					$time2 = date('Y/m/d H:i:s');
					
					echo '&nbsp;&nbsp;藍芽未連接<br>';
					echo '&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;';
					echo $time2;
					echo ' <br>'; 
					//發送EMAIL
					require_once('sendmailer.php');
					BluetoothNot();
					echo ' <br>'; 
					echo '  Email 發送成功';
						
					$tr='藍芽未連接<br>&nbsp;&nbsp;時間：<br>&nbsp;&nbsp;'
					.$time2.'<br>,';
					$fname = "x5.txt ";
					$xx  =  file_get_contents($fname);
					file_put_contents("x5.txt", $tr . $xx);
					$st = file_get_contents("x5.txt");
						
					$Arr=explode(",", $st);
					
					echo "<font style=\"font-size: 15pt\"><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>'; 
						
						
				}else{
						echo $str;
						echo 'ERROR<br>';
					}
					
			}else{
				$st = file_get_contents("x5.txt");
						
					$Arr=explode(",", $st);
					
					echo '<br>&nbsp;&nbsp;';  
					echo  $Arr[0]; //當前	
					echo ' <br>';
					
					echo "<font style=\"font-size: 15pt\"><br>上一筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Arr[1]; //紀錄表	
					echo ' <br>'; 
				
			}
		}
	?>	
	</div>
	
	<div id="rightH"><?php //一氧化碳 
		$time=0;
		$today=0;
		$t=0;
		header("Refresh:10"); //每10秒更新頁面
		
		if(isset($_POST['TestMQ7'])){
			$value = $_POST['TestMQ7' ];
			
			file_put_contents("s4.txt",$value);
			$str = file_get_contents("s4.txt");
				
			}
		else{
			$str = file_get_contents("s4.txt",FILE_USE_INCLUDE_PATH);
			
			//數值儲存
				$ostr=$str . '&';
				$fname = "a4.txt ";
				$aa  =  file_get_contents($fname);
				file_put_contents("a4.txt", $ostr . $aa);
				$ast = file_get_contents("a4.txt");	
				$aAr=explode("&", $ast);
				
				if($aAr[0]!= $aAr[1]){//如果量出的數值跟前一量測結果不一樣則進入
						
					date_default_timezone_set('Asia/Taipei');
					$t = date('Y/m/d H:i:s');
					
					$tr=$str . 'ppm&nbsp;&nbsp;' . $t . '<br>&nbsp;&nbsp;&nbsp;,';
					$fname = "x4.txt ";
					$xx  =  file_get_contents($fname);
					
					file_put_contents("x4.txt", $tr . $xx);
					
					$st = file_get_contents("x4.txt");
					
					$Ar=explode(",", $st);
					
					if($str<=300){ 
						echo '&nbsp;&nbsp;&nbsp;'; 
						echo 'CO濃度：<br>&nbsp;&nbsp;'; 	
						echo  $str;//數值
						echo 'ppm';  
						echo ' <br>&nbsp;&nbsp;&nbsp;';  			
						echo  $t; //當前時間
						echo ' <br>'; 
					}else{
						echo '&nbsp;&nbsp;&nbsp;'; 
						echo "<span style=\"color:#ff0000;\">CO濃度：</span>"; 
						echo '&nbsp;&nbsp;';
						echo "<span style=\"color:#ff0000;\">$str ppm</span>";//數值
						echo '<br>&nbsp;&nbsp;&nbsp;';  			
						echo "<span style=\"color:#ff0000;\">$t</span>";//當前時間
						echo ' <br>'; 
					}
					echo '<br>前3筆紀錄<br>';
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Ar[1]; //紀錄表	
					echo ' <br>'; 
					
					
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Ar[2]; //紀錄表	
					echo ' <br>'; 
					
					
					echo '&nbsp;&nbsp;&nbsp;';
					echo  $Ar[3]; //紀錄表	
					echo ' <br>'; 
				}else{
					$st = file_get_contents("x4.txt");
					
					$Ar=explode(",", $st);
					
					if($str<=300){
						echo '&nbsp;&nbsp;';  
						echo 'CO濃度：<br>&nbsp;&nbsp;'; 
						echo  $Ar[0]; //紀錄表	
						echo ' <br>';
					}else{
						echo '&nbsp;&nbsp;';  
						echo "<font style=\"font-size: 15pt\"><span style=\"color:#ff0000;\">CO濃度：</span></font>";
						echo "<br>&nbsp;&nbsp;";
						echo "<font style=\"font-size: 15pt\"><span style=\"color:#ff0000;\">$Ar[0]</span></font>" ;//紀錄表	
						echo ' <br>';  	
					}
					echo "<font style=\"font-size: 15pt\">前3筆紀錄<br></font>";
					echo '&nbsp;&nbsp;&nbsp;';
					echo "<font style=\"font-size: 10pt\">$Ar[1]</font>";//紀錄表
					echo ' <br>';
					
					if($Ar[2]!=null){
						echo '&nbsp;&nbsp;&nbsp;';
						echo  $Ar[2]; //紀錄表	
						echo ' <br>'; }
						
					if($Ar[3]!=null){
						echo '&nbsp;&nbsp;&nbsp;';
						echo  $Ar[3]; //紀錄表	
						echo ' <br>'; }
				}
			if($str>=300){ 
				require_once('sendmailer.php');
				Msmailer();
				echo ' <br>'; 
				echo '  Email 發送成功';
			   
			}	
			
		}
	
?>
	</div>

	
</div>
</body>

<section>

</section>
<div class="clearfix"></div>
<footer>
	<div class="primary-footer">
		<div class="container">
			<div class="row animate-effect">
				<div class="col-xs-12 col-sm-4">
					<h3>專題團隊 <i></i></h3>
					<p>學校: 南華大學</p>
					<p>指老教授: 柳茂林 教授</p>
					<p>團員: </p>
					<p>陳葒 李佳儒 賴瀅媜 陳哲恩</p>
					
				</div>
				<div class="col-xs-12 col-sm-4">
					<h3>居家守護 <i></i></h3>
					<ul class="list clearfix">
						<li>
							<a href="http://210.240.202.122/dashboard/moban2421/home.php">居家狀態</a>
						</li>
						<li>
							<a href="http://210.240.202.122/dashboard/moban2421/health.php">健康資訊</a>
						</li>
						<li>
							<a href="http://210.240.202.122/dashboard/moban2421/location.php">定位資訊</a>
						</li>
						
					</ul>
				</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/SmoothScroll.js" type="text/javascript"></script>
	<script src="js/jquery.stickOnScroll.js" type="text/javascript"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/application.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
</footer>
</body>

</html>