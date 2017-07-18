<?php
include "init.php";
header("Access-Control-Allow-Origin: *");
if($_POST) {
	addTime($_POST['name'], $db);
}	
?>