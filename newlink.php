<html>
<form action="newlink.php" method="post">
	<input type="text" name="link"></input>
	<button type="submit">Submit</button>
</form>
</html>

<?php
include "init.php";
if($_POST) {
	$link = $_POST['link'];
	if(strpos($link, '#xxx') !== false) {
		$link = str_replace("#xxx", "", $link);
		inputLink($link, $db);
		echo $link . " was submitted! #Confirmed";
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

		$email = "mitchellzinck@yahoo.com";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '. $email . "\r\n";
		$headers .= 'From: KARMABOT <mitch@mzinck.com>' . "\r\n";

		$body = "Someone tried to submit a link.<br>Url: " . $link . "<br>" . json_encode($details);

		sendMail($email, "Unathorized Link Submitted - KARMABOT", $body, $headers);

		echo "Invalid User.";
	}
}	
?>