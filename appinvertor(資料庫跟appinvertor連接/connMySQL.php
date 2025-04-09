<?php
	$db_host = "127.0.0.1";
	$db_username = "root";
	$db_password = "";
	$db_name = "appinventor_1";
	
	try {
		$pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=UTF8", $db_username, $db_password);
	} catch(PDOException $e) {
		print "資料庫連結失敗";
		die();
	}
?>