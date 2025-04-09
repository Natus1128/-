<?php
	include("connMySQL.php");
	
	$sql_query = "INSERT INTO temp VALUES(?, ?)";
	$result = $pdo->prepare($sql_query);
	
	if($result->execute([$_POST["t"], $_POST["time"]])) {
		echo "資料新增成功";
	}
	else {
		echo "資料新增失敗";
	}
?>