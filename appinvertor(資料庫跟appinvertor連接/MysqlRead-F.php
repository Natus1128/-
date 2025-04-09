<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM fall";
	$result = $pdo->query('select * from fall order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo "我 ";
		echo $row["g"], " ";
		echo "日期 : ";
		echo $row["time"];
		echo "</p>";
	}
?>