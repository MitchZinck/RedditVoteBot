<!DOCTYPE html>

<html lang="en">
<head>
	<meta name="keywords" content="Karma Bot Karmabot reddit top posts this hour" />
	<meta name="description" content="Karma Bot helps you find trending Reddit posts to gain Karma!" />
	<meta http-equiv="pictures-type" pictures="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>KarmaBot</title>
</head>
<body>
	<p id="text"></p>
</body>

<script>
function go() {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var data = "<pre><code>";
			var parsed = JSON.parse(xhr.responseText).data.children;
			var array;
			for(var i = 0; i < parsed.length; i++) {
				array = parsed[i].data;
				data += "<h3>" + array.title + "</h1> | " + "<a href=\"https://reddit.com" + array.permalink + "\" target=\"_blank\">" + array.permalink + "</a> | ⬆" + array.ups + " | " + getTime(array.created_utc) + " |<br>";
				//data += JSON.stringify(array) + "<br>";
			}
			data += "</code></pre>";
			document.getElementById("text").innerHTML = data;
		}
	};

	xhr.open("GET", "https://www.reddit.com/r/all/top.json?sort=top&t=hour&count=50", true);
	xhr.send();
}

function getTime(ts) {
	//var ts = Math.floor((new Date()).getTime() / 1000) - ts;
	// http://stackoverflow.com/a/847196
	// Create a new JavaScript Date object based on the timestamp
	// multiplied by 1000 so that the argument is in milliseconds, not seconds.
	var date = new Date(ts*1000);
	// Hours part from the timestamp
	var hours = date.getHours();
	// Minutes part from the timestamp
	var minutes = "0" + date.getMinutes();
	// Seconds part from the timestamp
	var seconds = "0" + date.getSeconds();
	// Will display time in 10:30:23 format
	console.log(minutes + " | " + ts + " | " + (minutes - new Date(new Date().getTime()).getMinutes()));

	var time = (minutes - new Date(new Date().getTime()).getMinutes());
	if(time > 0) {
		time = 60 - time;
	} else {
		time = Math.abs(time);
	}
 
	//return hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2) + (" | " + time + " minutes ago");
	return time + " minutes ago";
}

go();
</script>
</html>