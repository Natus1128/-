<?php
	include("connMySQL.php");

	$sql_query = "INSERT INTO gps VALUES(?, ?, ?)";
	$result = $pdo->prepare($sql_query);
	
if($result->execute([$_POST["lon"], $_POST["lat"], $_POST["time"]])) {
	if(isset($result)){
		$value = $result;

		file_put_contents("position.txt",$value);
		$str = file_get_contents("position.txt");
		echo $str;

	}
	else{
	$str = file_get_contents("position.txt");
	echo $str;
	}	
}

?>