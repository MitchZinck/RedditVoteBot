<?php	
	function canAccess($username, $db) {
		if(loggedIn() === true && userActive($username, $db) === true) {
			return true;
		}

		return false;
	}

	function checkUser($name, $vote_id, $db) {
		$query = $db->prepare("SELECT * FROM `voted` WHERE `name` = ? AND `vote_id` = ?");

	    if($query->execute(array($name, $vote_id))) {
			while($r = $query->fetch()) {
			    if($r[0] == 1) {
			    	return true;
			    }
			}
		}

		return false;
	}

	function getVoteURL($db) {
		$query = $db->query("SELECT `url` FROM `reddit_karma`.`links` WHERE `time` >= date_sub(NOW(), interval 90 minute)");
	    return $query->fetchAll();
	}

	function getVoted($name, $db) {
		$sql = "SELECT COUNT(*) FROM `reddit_karma`.`voted` where `name` = '" . $name . "'";
		$query = $db->prepare($sql);
		$query->execute();
		return $query->fetchColumn();
	}

	function addVote($name, $url, $db) {
		$query = $db->prepare("INSERT INTO `reddit_karma`.`voted` (name, url, time) VALUES (:name, :url, NOW())");
		$query->bindParam(':name', $name);
		$query->bindParam(':url', $url);
		$query->execute();
	}

	function addTime($name, $db) {
		$query = $db->prepare("INSERT INTO `reddit_karma`.`time` (name, time) VALUES (:name, NOW())");
		$query->bindParam(':name', $name);
		$query->execute();
	}

	function inputLink($url, $db) {
		$query = $db->prepare("INSERT INTO `reddit_karma`.`links` (url, time) VALUES (:url, NOW())");
		$query->bindParam(':url', $url);
		$query->execute();
	}

	function loggedIn() {
		return isset($_SESSION['user_id']) ? true : false;
	}

?>