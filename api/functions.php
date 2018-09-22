<?php
	// Function to fetch Facebook events from a page
	function fetchFacebookEvents($pageId) {
		$events = json_decode(file_get_contents("https://graph.facebook.com/". $pageId ."?fields=events{cover,description,end_time,id,name,owner,place,start_time}&access_token=1624518521098250|ny49xbjQMVQUUfVTAqkuzQ2naAQ"),true);
		$timeNow = time();
		// Doing a foreach to insert every events inside the database.
		foreach($events["events"]["data"] as $item) {
			if(!isset ($item["description"])) continue;
			$timeEvent = strtotime($item["start_time"]);
			if($timeNow > $timeEvent) continue;

			// Insert category inside the database
			mysql_query("INSERT INTO `categories` VALUES('','".$item["owner"]["category"]."','".$item["owner"]["category"]."')");
			// Insert the event inside the database
			mysql_query("INSERT INTO `events` VALUES('','".$item["id"]."','".$item["owner"]["category"]."','".$item["owner"]["name"]."','".$item["name"]."','".$item["description"]."','".$item["cover"]["source"]."','".json_encode($item["place"])."','".$item["start_time"]."','1')");
		}

		return "Operation finished with success";
	}

	function getEvent($id) {
		$id = htmlspecialchars(addslashes($id));

		$event = mysql_fetch_assoc(mysql_query("SELECT * FROM `events` WHERE `id` = '" . $id . "' "));

		return $event;
	}

	function getEvents($category,$searchQuery) {

		$query = "SELECT * FROM `events` ";
		if($category != "all") $query .= "WHERE `catName`='".$category."' ";

		// an steiloume search query , psaxnoume se ola ta pedia
		if($searchQuery != null){
			$query .= ($category != "all") ? "AND " : "WHERE ";
			$query .= "`name` LIKE '%".$searchQuery."%' ";
			$query .= "OR `description` LIKE '%".$searchQuery."%' ";
}

		$query .= "ORDER BY `date` DESC";

		$events = mysql_query($query);
		while($event = mysql_fetch_assoc($events)) {
			$response[$event["id"]] = $event;
			$response[$event["id"]]["date"] = date("d/m/Y",strtotime($event["date"]));
			$response[$event["id"]]["hour"] = date("H:i",strtotime($event["date"]));
		}

		return json_encode($response);
	}

	function getPages() {
		$query = "SELECT * FROM `pages` ORDER BY `id` DESC";
		$pages = mysql_query($query);
		while($page = mysql_fetch_assoc($pages)) {
			$response[$page["id"]] = $page;
		}

		return json_encode($response);

	}

	function deletePage($id) {
		$id = htmlspecialchars(addslashes($id));

		mysql_query("DELETE FROM `pages` WHERE `id`='" . $id . "'");

		return true;
	}

	function getCategories() {
		$categories = mysql_query("SELECT * FROM `categories` ORDER BY `id` DESC");
		while($category = mysql_fetch_assoc($categories)) {
			$response[$category["id"]] = $category;
		}

		return json_encode($response);
	}

	// Function for cronjob, checking database & deleting unexisting events.
	function checkDatabase() {
		$events = mysql_query("SELECT `id`,`date` FROM `events` ORDER BY `id` DESC");
		while($event = mysql_fetch_assoc($events)) {
			$timeNow = time(); 
			$timeEvent = strtotime($event["date"]);
			var_dump($timeNow . " - " . $timeEvent);
			if($timeNow > $timeEvent) {
				mysql_query("DELETE FROM `events` WHERE `id`='".$event["id"]."'");
			}

		}
		return "Database checked.";
	}

	function addPage($url) {
		$page = explode(".com/",htmlspecialchars(addslashes($url)));
		$page = (isset($page[1])) ? $page[1] : $page[0];

		$pageName =  json_decode(file_get_contents("https://graph.facebook.com/". $page ."?access_token=1624518521098250|ny49xbjQMVQUUfVTAqkuzQ2naAQ"),true);
		$pageName = $pageName["name"]; 

		mysql_query("INSERT INTO `pages` VALUES('','" . $page . "', '" . htmlspecialchars(addslashes($pageName)) . "')");
		
		fetchFacebookEvents($page);

		return true;
	}

	function changeState($id) {
		$id = htmlspecialchars(addslashes($id));

		$event = getEvent($id);
		$showState = ($event["show"] == 0) ? 1 : 0;

		mysql_query("UPDATE `events` SET `show`='" . $showState . "' WHERE `id`='" . $id . "'");

		return true;
	}
?>