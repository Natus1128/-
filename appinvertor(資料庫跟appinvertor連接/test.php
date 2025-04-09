<?php
	include("connMySQL.php");

	$input_name="距離過遠";

  	$sql = "SELECT * FROM test";
  	$result = $pdo->query($sql_query);

	foreach($result as $row) {
		$db_name=$row['d'];		//$db_name 存取資料庫讀取的資料
	}
	if($db_name==$input_name){
		// echo $input_name;
		echo $_POST[$input_name];
	}

  	// while($row = mysql_fetch_row($result))
  		// echo $row["d"];

?>