<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM help";
	$result = $pdo->query('select * from help order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo "我需要 ";
		echo $row["h"], " ";
		echo "日期 : ";
		echo $row["time"];
		echo "</p>";
	}
?>