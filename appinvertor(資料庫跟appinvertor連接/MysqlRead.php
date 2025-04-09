<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM gps";
	$result = $pdo->query('select * from gps order by time desc;');
	
	foreach($result as $row) {
		echo "<p>";
		echo "GPS : ";
		echo $row["lat"], ",";  //緯度
		echo $row["lon"], "：";  //經度
		echo $row["time"];
		echo "</p>";
	}
?>