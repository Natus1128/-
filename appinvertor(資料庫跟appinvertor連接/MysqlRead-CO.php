<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM co";
	$result = $pdo->query('select * from co order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo "CO : ";
		echo $row["o"], " ppm ";
		echo "日期 : ";
		echo $row["time"];
		echo "</p>";
	}
?>