<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM temp";
	$result = $pdo->query('select * from temp order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo "體溫 : ";
		echo $row["t"], " 度 ";
		echo "日期 : ";
		echo $row["time"];
		echo "</p>";
	}
?>