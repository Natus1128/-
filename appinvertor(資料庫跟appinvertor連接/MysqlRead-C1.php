<?php
	include("connMySQL.php");
	
	$sql_query = "SELECT * FROM test";
	$result = $pdo->query($sql_query);
	
	foreach($result as $row) {
		echo "<p>";
		echo $row["d"], " ";
		echo "</p>";
	}
    
?>