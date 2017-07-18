<html>
<h3>Enter your reddit account name</h3>
<form action="checkaccount.php" method="post">
	<input type="text" name="name"></input>
	<button type="submit">Submit</button>
</form>
</html>

<?php
include "init.php";
if($_POST) {
	echo "You have voted " . getVoted($_POST['name'], $db)[0] . " number of times!";
}	
?>