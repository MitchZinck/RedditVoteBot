<?php
include "init.php";
header("Access-Control-Allow-Origin: *");

if($_SERVER['REQUEST_METHOD'] === 'GET') {	
	$url = getVoteUrl($db);
	if($url === "") {
		echo "onep_nothing";
	} else {
		echo end($url)[0];
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	var_dump($_POST);
	addVote($_POST['name'], $_POST['link'], $db);
}
?>