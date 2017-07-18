<?php	
	try {
		$db = new PDO("mysql:host=localhost;dbname=xxx", "xxx", "xxx");
	} catch(PDOException $e) {
		echo $e->getMessage();
		die();
	}
?>