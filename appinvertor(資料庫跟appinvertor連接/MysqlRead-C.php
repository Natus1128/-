<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM cut";
	$result = $pdo->query('select * from cut order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo $row["d"], " ";
		echo "日期 : ";
		echo $row["time"];
		echo "</p>";
	}
?>