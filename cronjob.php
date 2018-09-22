<?php
	require_once("config.php");
	include("api/functions.php");

	//  Checkaroume page ana page apo tin  database (xrisimopoiwdas to internal API)
	$pages = mysql_query("SELECT * FROM `pages`");
	while($page = mysql_fetch_assoc($pages)) {
		try {
			fetchFacebookEvents($page["pageId"]);
			print $page["pageId"] . " successfully checked...\n\r";
		} catch(Exception $e) {
			print $page["pageId"] . " encountered an error...\n\r";
		}
	}

	//Checkaroume tin database gia na kanoume delete palia events (xrisimopoiwdas to internal API)
	checkDatabase();

	print "Task over.\n\r";
?>